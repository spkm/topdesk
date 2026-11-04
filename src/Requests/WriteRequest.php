<?php

namespace spkm\Topdesk\Requests;

use JsonSerializable;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\PendingRequest;
use Saloon\Repositories\Body\JsonBodyRepository;
use Saloon\Traits\Body\HasJsonBody;

/**
 * A POST, PUT or PATCH carrying JSON: a record as an array of TOPdesk's field names or a model, or a list (a JSON
 * Patch, or the ids a bulk operation takes). TOPdesk answers with the record as stored, or with nothing.
 */
abstract class WriteRequest extends TopdeskRequest implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected string $responseShape = self::RAW;

    protected bool $safe = false;

    /** @var array<mixed>|JsonSerializable */
    protected array|JsonSerializable $record = [];

    /** @var array<string, mixed> */
    protected array $options = [];

    /**
     * Whether the endpoint takes a JSON list rather than an object, so that an empty body is sent as [] not {}.
     */
    protected bool $listBody = false;

    /**
     * The body's content type when it isn't plain JSON: TOPdesk's merge patch, or a JSON Patch.
     */
    protected ?string $contentType = null;

    /**
     * Sends an empty body as {}: TOPdesk reads an endpoint's body as an object, and refuses [].
     */
    public function boot(PendingRequest $pendingRequest): void
    {
        $body = $pendingRequest->body();

        if (! $this->listBody && $body instanceof JsonBodyRepository && $body->isEmpty()) {
            $body->setJsonFlags($body->getJsonFlags() | JSON_FORCE_OBJECT);
        }
    }

    /**
     * @return array<string, string>
     */
    protected function defaultHeaders(): array
    {
        return $this->contentType === null ? parent::defaultHeaders() : [...parent::defaultHeaders(), 'Content-Type' => $this->contentType];
    }

    /**
     * @return array<mixed>
     */
    protected function defaultBody(): array
    {
        return $this->record instanceof JsonSerializable ? (array) $this->record->jsonSerialize() : $this->record;
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        return $this->options;
    }
}
