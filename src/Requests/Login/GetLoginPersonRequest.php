<?php

namespace spkm\Topdesk\Requests\Login;

use Illuminate\Support\Carbon;
use JsonException;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Response;
use spkm\Topdesk\Auth\TokenRequest;
use spkm\Topdesk\Exceptions\ServerErrorException;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Login - as a person: GET /tas/api/login/person.
 *
 * Signs a person in with their login name and password over basic auth, and gives the token TOPdesk issues for
 * them, which the connector sends as Authorization: TOKEN id="...". TOPdesk doesn't say how long a token lasts;
 * the connector keeps it for topdesk.person_token_seconds and signs in again when TOPdesk refuses it.
 */
class GetLoginPersonRequest extends GetRequest implements TokenRequest
{
    protected string $responseShape = self::RAW;

    protected bool $cacheable = false;

    public function __construct(protected string $loginName, #[\SensitiveParameter] protected string $password) {}

    public function resolveEndpoint(): string
    {
        return '/tas/api/login/person';
    }

    protected function defaultAuth(): Authenticator
    {
        return new BasicAuthenticator($this->loginName, $this->password);
    }

    public function tokenFrom(Response $response): array
    {
        $body = trim($response->body());

        try {
            $token = json_validate($body) ? json_decode($body, false, flags: JSON_THROW_ON_ERROR) : $body;
        } catch (JsonException) {
            $token = null;
        }

        if (! is_string($token) || trim($token) === '') {
            throw new ServerErrorException($response);
        }

        return ['token' => trim($token), 'expires_at' => Carbon::now()->getTimestamp() + max(1, (int) config('topdesk.person_token_seconds', 1200))];
    }

    /**
     * What a dump shows: everything but the password.
     *
     * @return array<string, mixed>
     */
    public function __debugInfo(): array
    {
        return ['loginName' => $this->loginName, 'password' => '[redacted]'];
    }
}
