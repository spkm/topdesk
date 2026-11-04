<?php

namespace spkm\Topdesk;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use JsonException;
use JsonSerializable;
use LogicException;
use Psr\Http\Message\RequestInterface;
use Saloon\Config;
use Saloon\Contracts\Authenticator;
use Saloon\Enums\Method;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\PendingRequest;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\Traits\Plugins\HasTimeout;
use spkm\Topdesk\Auth\Credentials;
use spkm\Topdesk\Auth\TokenRequest;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Requests\AdhocBodyRequest;
use spkm\Topdesk\Requests\AdhocRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\Resources\AdhocResource;
use spkm\Topdesk\Resources\HasResources;
use spkm\Topdesk\Support\QueryString;

/**
 * The connection to one TOPdesk server: a resource for every group of endpoints TOPdesk documents, paging, and
 * ad-hoc calls for anything else. It signs in as the credentials say: an operator's application token over basic
 * auth, or a token fetched before the first request (from the cache, encrypted, when one is there) and again when
 * it is about to expire or TOPdesk refuses it, for a person or an OAuth client.
 */
class TopdeskConnector extends Connector implements HasPagination
{
    use HasResources;
    use HasTimeout;

    /**
     * How long before a token expires the connector fetches a new one, at most.
     */
    public const REFRESH_MARGIN = 60;

    protected float $connectTimeout;

    protected float $requestTimeout;

    /**
     * When the token held should be replaced (a Unix timestamp), or null when none is held.
     */
    protected ?int $refreshAt = null;

    public function __construct(protected Credentials $credentials)
    {
        $this->connectTimeout = self::timeout(config('topdesk.timeouts.connect'), Config::$defaultConnectionTimeout);
        $this->requestTimeout = self::timeout(config('topdesk.timeouts.request'), Config::$defaultRequestTimeout);

        if (config('topdesk.retries.times')) {
            $this->tries = (int) config('topdesk.retries.times');
            $this->retryInterval = (int) config('topdesk.retries.interval_ms', 500);
            $this->useExponentialBackoff = true;
            $this->throwOnMaxTries = false;
        }
    }

    /**
     * The server's address, such as https://yourcompany.topdesk.net, whatever path it was configured with. Every
     * request carries its full path from here (/tas/api/..., /services/..., /oauth/...), as TOPdesk's APIs live
     * under different roots.
     */
    public function resolveBaseUrl(): string
    {
        return $this->baseUrl();
    }

    /**
     * The server's address: the root of TOPdesk's own pages too, for a link such as
     * baseUrl().'/tas/secure/incident?unid='.$id.
     */
    public function baseUrl(): string
    {
        return $this->credentials->baseUrl;
    }

    public function credentials(): Credentials
    {
        return $this->credentials;
    }

    /**
     * A fingerprint of the server and who signs in to it, so that what one sign-in fetched is never served to
     * another (the response cache keys on it) without the credentials being written anywhere.
     */
    public function credentialsFingerprint(): string
    {
        return hash('sha256', $this->baseUrl().'|'.$this->credentials->identity());
    }

    protected function defaultAuth(): ?Authenticator
    {
        return $this->credentials->authenticator();
    }

    public function send(Request $request, ?MockClient $mockClient = null, ?callable $handleRetry = null): Response
    {
        $this->ensureAuthenticated($request);

        $response = parent::send($request, $mockClient, $handleRetry);

        if ($response->status() === 401 && $this->credentials->usesToken() && config('topdesk.reauthenticate', true) && ! $request instanceof TokenRequest) {
            $this->forgetToken();
            $this->ensureAuthenticated($request);

            return parent::send($request, $mockClient, $handleRetry);
        }

        return $response;
    }

    public function sendAsync(Request $request, ?MockClient $mockClient = null): PromiseInterface
    {
        $this->ensureAuthenticated($request);

        return parent::sendAsync($request, $mockClient);
    }

    /**
     * Forget the token: the one this connector holds and the cached one, so the next request fetches a new one.
     */
    public function forgetToken(): void
    {
        Cache::forget($this->tokenCacheKey());
        $this->authenticator = null;
        $this->refreshAt = null;
    }

    /**
     * Holds a valid token before a request that needs one: the cached one, or a new one from TOPdesk. An
     * application token needs nothing fetched, and building a connector never contacts TOPdesk.
     */
    protected function ensureAuthenticated(Request $request): void
    {
        if (! $this->credentials->usesToken() || $request instanceof TokenRequest) {
            return;
        }

        if ($this->authenticator === null || $this->refreshAt === null || $this->refreshAt <= Carbon::now()->getTimestamp()) {
            $token = $this->cachedToken() ?? $this->fetchToken();
            $this->authenticate($this->credentials->tokenAuthenticator($token['token']));
            $this->refreshAt = $token['refresh_at'];
        }
    }

    /**
     * The token in the cache for this server and sign-in, when there is one with time left.
     *
     * @return array{token: string, expires_at: int, refresh_at: int}|null
     */
    private function cachedToken(): ?array
    {
        $cached = Cache::get($this->tokenCacheKey());

        if (! is_string($cached)) {
            return null;
        }

        try {
            $token = json_decode(Crypt::decryptString($cached), true, flags: JSON_THROW_ON_ERROR);
        } catch (DecryptException|JsonException) {
            return null;
        }

        if (! is_array($token) || ! is_string($token['token'] ?? null) || ! is_int($token['expires_at'] ?? null) || ! is_int($token['refresh_at'] ?? null)) {
            return null;
        }

        return $token['refresh_at'] > Carbon::now()->getTimestamp() ? $token : null;
    }

    /**
     * A new token from TOPdesk, cached (encrypted) until it is due to be replaced. It is replaced a minute before
     * it expires, or halfway through its life when that is shorter.
     *
     * @return array{token: string, expires_at: int, refresh_at: int}
     */
    private function fetchToken(): array
    {
        $request = $this->credentials->tokenRequest() ?? throw new LogicException('These credentials need no token.');

        try {
            $response = $this->send($request);
        } catch (RequestException $exception) {
            throw TopdeskApiException::fromResponse($exception->getResponse());
        }

        if (! $response->successful()) {
            throw TopdeskApiException::fromResponse($response);
        }

        $token = $request->tokenFrom($response);
        $now = Carbon::now()->getTimestamp();
        $lifetime = max(0, $token['expires_at'] - $now);
        $token['refresh_at'] = $token['expires_at'] - min(self::REFRESH_MARGIN, intdiv($lifetime, 2));

        if ($token['refresh_at'] > $now) {
            Cache::put($this->tokenCacheKey(), Crypt::encryptString(json_encode($token, JSON_THROW_ON_ERROR)), Carbon::createFromTimestamp($token['refresh_at']));
        }

        return $token;
    }

    /**
     * The token's cache key: one per server and sign-in, hashed so neither appears in the cache.
     */
    private function tokenCacheKey(): string
    {
        return 'topdesk.token.'.sha1($this->baseUrl().'|'.$this->credentials->identity());
    }

    /**
     * Page through a list request, $perPage records at a time (topdesk.pagination.per_page by default, at most what
     * the endpoint allows).
     */
    public function paginate(Request $request, ?int $perPage = null): TopdeskPaginator
    {
        return new TopdeskPaginator($this, $request, $perPage ?? (int) config('topdesk.pagination.per_page', 100));
    }

    /**
     * A query over a collection the package has no resource for, as Topdesk::from('incidents'); its records are
     * arrays. A record is found, updated and deleted at $itemPath ({path}/{id} by default; 'incidents/id/{id}' for
     * one TOPdesk writes that way).
     *
     * @return Builder<Data>
     */
    public function from(string $path, ?string $itemPath = null, Method $updateMethod = Method::PATCH): Builder
    {
        return new AdhocResource($this, $path, $itemPath, $updateMethod);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function get(string $path, array $query = []): Response
    {
        return $this->send(new AdhocRequest(Method::GET, $path, $query));
    }

    /**
     * @param  array<mixed>|JsonSerializable  $body
     * @param  array<string, mixed>  $query
     */
    public function post(string $path, array|JsonSerializable $body = [], array $query = []): Response
    {
        return $this->send(new AdhocBodyRequest(Method::POST, $path, $body, $query));
    }

    /**
     * @param  array<mixed>|JsonSerializable  $body
     * @param  array<string, mixed>  $query
     */
    public function put(string $path, array|JsonSerializable $body = [], array $query = []): Response
    {
        return $this->send(new AdhocBodyRequest(Method::PUT, $path, $body, $query));
    }

    /**
     * @param  array<mixed>|JsonSerializable  $body
     * @param  array<string, mixed>  $query
     */
    public function patch(string $path, array|JsonSerializable $body = [], array $query = []): Response
    {
        return $this->send(new AdhocBodyRequest(Method::PATCH, $path, $body, $query));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function delete(string $path, array $query = []): Response
    {
        return $this->send(new AdhocRequest(Method::DELETE, $path, $query));
    }

    /**
     * Writes the query string with a parameter that has several values repeated (cardType=change&cardType=activity),
     * rather than PHP's cardType[0]=change.
     */
    public function handlePsrRequest(RequestInterface $request, PendingRequest $pendingRequest): RequestInterface
    {
        $uri = $request->getUri();
        $existing = QueryString::parse((string) parse_url($pendingRequest->getUrl(), PHP_URL_QUERY));

        return $request->withUri($uri->withQuery(QueryString::encode([...$existing, ...$pendingRequest->query()->all()])));
    }

    /**
     * Retry only a request that changes nothing, and only for a fault on TOPdesk's side or the way there.
     */
    public function handleRetry(FatalRequestException|RequestException $exception, Request $request): bool
    {
        $isSafe = $request instanceof TopdeskRequest ? $request->isSafe() : $request->getMethod() === Method::GET;

        if (! $isSafe) {
            return false;
        }

        return $exception instanceof FatalRequestException
            || in_array($exception->getResponse()->status(), [408, 429], true)
            || $exception->getResponse()->serverError();
    }

    /**
     * A timeout from config: seconds, or the default when the value is empty or not positive (a zero would mean
     * waiting forever).
     */
    private static function timeout(mixed $value, float $default): float
    {
        return is_numeric($value) && (float) $value > 0 ? (float) $value : $default;
    }

    /**
     * What a dump shows: the server and who signs in, never a secret or a token.
     *
     * @return array<string, mixed>
     */
    public function __debugInfo(): array
    {
        return ['baseUrl' => $this->baseUrl(), 'identity' => $this->credentials->identity(), 'token' => $this->credentials->usesToken() && $this->authenticator !== null ? '[redacted]' : null];
    }

    /**
     * A connector holds the credentials and a token, so it is never written out with a queued job or a session;
     * build one from config where it is needed.
     *
     * @return array<string, mixed>
     */
    public function __serialize(): array
    {
        throw new LogicException('A TOPdesk connector cannot be serialised; resolve it from the Topdesk facade or config where it is used.');
    }

    /**
     * @return array<string, string>
     */
    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }
}
