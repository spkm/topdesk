<?php

namespace spkm\Topdesk\Requests\OAuth;

use Illuminate\Support\Carbon;
use Saloon\Contracts\Authenticator;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use spkm\Topdesk\Auth\TokenRequest;
use spkm\Topdesk\Data\OAuth\TokenResponse;
use spkm\Topdesk\Exceptions\ServerErrorException;
use spkm\Topdesk\Requests\TopdeskRequest;

/**
 * Obtain an access token for API requests: POST /oauth/token.
 *
 * Exchanges an OAuth client's id and secret (sent over basic auth) for an access token, by the client credentials
 * grant unless the form says otherwise: grant_type authorization_code with a code and redirect_uri, or
 * refresh_token with a refresh_token.
 */
class CreateOAuthTokenRequest extends TopdeskRequest implements HasBody, TokenRequest
{
    use HasFormBody;

    protected Method $method = Method::POST;

    protected string $responseShape = self::ONE;

    protected ?string $dto = TokenResponse::class;

    protected bool $safe = false;

    /**
     * @param  array<string, mixed>  $form  The grant and what it needs.
     */
    public function __construct(protected string $clientId, #[\SensitiveParameter] protected string $clientSecret, protected array $form = ['grant_type' => 'client_credentials']) {}

    public function resolveEndpoint(): string
    {
        return '/oauth/token';
    }

    protected function defaultAuth(): Authenticator
    {
        return new BasicAuthenticator($this->clientId, $this->clientSecret);
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        return $this->form;
    }

    public function tokenFrom(Response $response): array
    {
        $body = $response->json();
        $token = $body['access_token'] ?? null;

        if (! is_string($token) || $token === '') {
            throw new ServerErrorException($response);
        }

        return ['token' => $token, 'expires_at' => Carbon::now()->getTimestamp() + (is_numeric($body['expires_in'] ?? null) ? (int) $body['expires_in'] : 3600)];
    }

    /**
     * What a dump shows: everything but the secret.
     *
     * @return array<string, mixed>
     */
    public function __debugInfo(): array
    {
        return ['clientId' => $this->clientId, 'clientSecret' => '[redacted]', 'grant' => $this->form['grant_type'] ?? null];
    }
}
