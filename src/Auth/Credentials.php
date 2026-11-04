<?php

namespace spkm\Topdesk\Auth;

use InvalidArgumentException;
use LogicException;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use spkm\Topdesk\Requests\Login\GetLoginPersonRequest;
use spkm\Topdesk\Requests\OAuth\CreateOAuthTokenRequest;
use spkm\Topdesk\Requests\TopdeskRequest;

/**
 * How the package signs in to one TOPdesk server:
 *
 * - an operator's application token (an "application password" in older versions), sent over basic auth with the
 *   operator's login name, which is what TOPdesk recommends for an integration;
 * - a person's login name and password, exchanged for a token, for the self-service portal's /requester endpoints;
 * - an OAuth client's id and secret, exchanged for an access token by the client credentials grant.
 *
 * The address is kept without the path TOPdesk's own pages and APIs sit under, so https://yourcompany.topdesk.net/tas/
 * and https://yourcompany.topdesk.net/tas/api both give https://yourcompany.topdesk.net.
 */
final readonly class Credentials
{
    private const APPLICATION_TOKEN = 'operator';

    private const PERSON = 'person';

    private const OAUTH = 'client';

    public string $baseUrl;

    private function __construct(
        string $baseUrl,
        private string $kind,
        public string $username,
        private string $secret,
    ) {
        if (trim($baseUrl) === '') {
            throw new InvalidArgumentException('TOPdesk credentials need the server\'s address.');
        }

        $this->baseUrl = (string) preg_replace('#(/tas(/api)?)?/*$#i', '', trim($baseUrl));
    }

    /**
     * An operator's application token, from My settings, or from an API account's card.
     */
    public static function applicationToken(string $baseUrl, string $loginName, #[\SensitiveParameter] string $token): self
    {
        if ($loginName === '' || $token === '') {
            throw new InvalidArgumentException('An application token needs the operator\'s login name and the token.');
        }

        return new self($baseUrl, self::APPLICATION_TOKEN, $loginName, $token);
    }

    /**
     * A person (a self-service portal user), signing in with their login name and password.
     */
    public static function person(string $baseUrl, string $loginName, #[\SensitiveParameter] string $password): self
    {
        if ($loginName === '' || $password === '') {
            throw new InvalidArgumentException('A person needs a login name and a password.');
        }

        return new self($baseUrl, self::PERSON, $loginName, $password);
    }

    /**
     * An OAuth client, from TOPdesk's Connected applications.
     */
    public static function oauth(string $baseUrl, string $clientId, #[\SensitiveParameter] string $clientSecret): self
    {
        if ($clientId === '' || $clientSecret === '') {
            throw new InvalidArgumentException('An OAuth client needs a client id and a client secret.');
        }

        return new self($baseUrl, self::OAUTH, $clientId, $clientSecret);
    }

    /**
     * Whether signing in means fetching a token first: true for a person and an OAuth client.
     */
    public function usesToken(): bool
    {
        return $this->kind !== self::APPLICATION_TOKEN;
    }

    public function isPerson(): bool
    {
        return $this->kind === self::PERSON;
    }

    /**
     * Who signs in: operator:{login name}, person:{login name} or client:{client id}.
     */
    public function identity(): string
    {
        return $this->kind.':'.$this->username;
    }

    /**
     * What signs every request in, for an application token; null for credentials that fetch a token first.
     */
    public function authenticator(): ?Authenticator
    {
        return $this->usesToken() ? null : new BasicAuthenticator($this->username, $this->secret);
    }

    /**
     * The request that exchanges these credentials for a token; null for an application token, which needs none.
     */
    public function tokenRequest(): (TopdeskRequest&TokenRequest)|null
    {
        return match ($this->kind) {
            self::PERSON => new GetLoginPersonRequest($this->username, $this->secret),
            self::OAUTH => new CreateOAuthTokenRequest($this->username, $this->secret),
            default => null,
        };
    }

    /**
     * What signs a request in with a token TOPdesk gave: TOKEN id="..." for a person, a bearer token for a client.
     */
    public function tokenAuthenticator(#[\SensitiveParameter] string $token): Authenticator
    {
        return $this->isPerson() ? new TokenAuthenticator('id="'.$token.'"', 'TOKEN') : new TokenAuthenticator($token);
    }

    /**
     * What a dump shows: everything but the secret.
     *
     * @return array<string, mixed>
     */
    public function __debugInfo(): array
    {
        return [
            'baseUrl' => $this->baseUrl,
            'identity' => $this->identity(),
            'secret' => '[redacted]',
        ];
    }

    /**
     * Credentials are never written out with a queued job or a session; build them from config where they are
     * needed.
     *
     * @return array<string, mixed>
     */
    public function __serialize(): array
    {
        throw new LogicException('TOPdesk credentials cannot be serialised; resolve the connector from the Topdesk facade or config where it is used.');
    }
}
