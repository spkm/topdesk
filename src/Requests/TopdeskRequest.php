<?php

namespace spkm\Topdesk\Requests;

use Illuminate\Support\Facades\Cache;
use JsonException;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Enums\Method;
use Saloon\Http\PendingRequest;
use Saloon\Http\Request;
use Saloon\Http\Response;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Exceptions\ServerErrorException;
use spkm\Topdesk\Support\Payload;
use spkm\Topdesk\Support\QueryString;
use spkm\Topdesk\TopdeskApiException;
use spkm\Topdesk\TopdeskConnector;
use Throwable;

/**
 * What every request to TOPdesk shares: the shape of the response and the model it maps to (for dto()), the
 * version of the record to ask for, and optional response caching.
 */
abstract class TopdeskRequest extends Request implements Cacheable
{
    use HasCaching;

    /** One record: a model, or an array when the request has none. */
    public const ONE = 'one';

    /** A list of records, or a page of them: a Collection of models, or of arrays. */
    public const LIST = 'list';

    /** The decoded body as it is. */
    public const RAW = 'raw';

    /** The body as a string: a file, an image, an avatar. */
    public const TEXT = 'text';

    /** Nothing worth reading: dto() gives null. */
    public const NONE = 'none';

    protected string $responseShape = self::NONE;

    /** @var class-string<Data>|null */
    protected ?string $dto = null;

    protected bool $cacheable = false;

    protected bool $safe = true;

    /**
     * The media type to ask for, when it isn't plain JSON: a version of the record TOPdesk serves in more than
     * one (application/x.topdesk-person-v2+json), or a file's type.
     */
    protected ?string $accept = null;

    /**
     * @return array<string, string>
     */
    protected function defaultHeaders(): array
    {
        return $this->accept === null ? [] : ['Accept' => $this->accept];
    }

    public function resolveCacheDriver(): Driver
    {
        return new LaravelCacheDriver(Cache::store(config('topdesk.cache.store')));
    }

    public function cacheExpiryInSeconds(): int
    {
        return (int) config('topdesk.cache.seconds', 3600);
    }

    /**
     * @return array<Method>
     */
    protected function getCacheableMethods(): array
    {
        return $this->cacheable && config('topdesk.cache.enabled') ? [Method::GET] : [];
    }

    /**
     * One entry per server and sign-in, so what one fetched is never served to another, and per query as it is
     * sent.
     */
    protected function cacheKey(PendingRequest $pendingRequest): string
    {
        $connector = $pendingRequest->getConnector();
        $identity = $connector instanceof TopdeskConnector ? $connector->credentialsFingerprint() : $connector::class;

        return 'topdesk.response.'.sha1($identity.' '.$pendingRequest->getMethod()->value.' '.$pendingRequest->getUrl().' '.QueryString::encode($pendingRequest->query()->all()));
    }

    /**
     * The exception for an error answer, so that $response->throw() (and the paginator, which calls it) gives
     * TOPdesk's own exception classes rather than Saloon's.
     */
    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        return TopdeskApiException::fromResponse($response);
    }

    /**
     * Whether the request can be retried: a GET that changes nothing.
     */
    public function isSafe(): bool
    {
        return $this->safe && $this->getMethod() === Method::GET;
    }

    /**
     * @return class-string<Data>|null
     */
    public function dtoClass(): ?string
    {
        return $this->dto;
    }

    public function responseShape(): string
    {
        return $this->responseShape;
    }

    /**
     * The media type the request asks for, or null for plain JSON.
     */
    public function accepts(): ?string
    {
        return $this->accept;
    }

    /**
     * The response as the request's model (or models, or arrays for a request without one; or the body as a string
     * for a file), an empty collection for a list TOPdesk answered with 204 No Content, null for any other answer
     * without a body, or a TopdeskApiException for an error status.
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        if (! $response->successful()) {
            throw TopdeskApiException::fromResponse($response);
        }

        if ($this->responseShape === self::TEXT) {
            return $response->body();
        }

        if ($this->responseShape === self::LIST && trim($response->body()) === '') {
            return collect();
        }

        if (trim($response->body()) === '') {
            return null;
        }

        try {
            return match ($this->responseShape) {
                self::ONE => Payload::object($response, $this->dto),
                self::LIST => Payload::items($response, $this->dto),
                self::RAW => Payload::json($response),
                default => null,
            };
        } catch (JsonException) {
            // A successful status with something other than JSON, such as a proxy's or a maintenance page.
            throw new ServerErrorException($response);
        }
    }
}
