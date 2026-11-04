<?php

namespace spkm\Topdesk;

use BadMethodCallException;
use InvalidArgumentException;
use spkm\Topdesk\Auth\Credentials;

/**
 * What the Topdesk facade resolves: the connector for the default server, built from config('topdesk') the first
 * time it is needed, and for any named connections. Methods the service doesn't have go to the default server's
 * connector.
 *
 * @mixin TopdeskConnector
 */
class TopdeskService
{
    /** @var array<string, TopdeskConnector> */
    protected array $connectors = [];

    /**
     * The connector for another server, configured under topdesk.connections.{name}.
     */
    public function connection(string $name): TopdeskConnector
    {
        return $this->connector($name);
    }

    /**
     * The connector: the default server's, or a named connection's.
     */
    public function connector(?string $connection = null): TopdeskConnector
    {
        return $this->connectors[$connection ?? ''] ??= new TopdeskConnector($this->credentials($this->config($connection), $this->describe($connection)));
    }

    /**
     * A connector signed in as a person (a self-service portal user) with their login name and password, to the
     * default server or a named connection's, for the /requester endpoints.
     */
    public function asPerson(string $loginName, #[\SensitiveParameter] string $password, ?string $connection = null): TopdeskConnector
    {
        $baseUrl = $this->setting($this->config($connection), 'base_url') ?? throw new InvalidArgumentException($this->describe($connection).' needs a base_url.');

        return new TopdeskConnector(Credentials::person($baseUrl, $loginName, $password));
    }

    /**
     * @param  array<mixed>  $parameters
     */
    public function __call(string $method, array $parameters): mixed
    {
        $connector = $this->connector();

        if (method_exists($connector, $method)) {
            return $connector->{$method}(...$parameters);
        }

        throw new BadMethodCallException("Method {$method} does not exist.");
    }

    /**
     * @return array<mixed>
     */
    private function config(?string $connection): array
    {
        if ($connection === null) {
            return (array) config('topdesk');
        }

        $config = config("topdesk.connections.$connection");

        if (! is_array($config)) {
            throw new InvalidArgumentException('No TOPdesk connection named "'.$connection.'" is configured in topdesk.connections.');
        }

        return $config;
    }

    private function describe(?string $connection): string
    {
        return $connection === null ? 'The default TOPdesk connection' : 'The TOPdesk connection "'.$connection.'"';
    }

    /**
     * The credentials a connection's config gives: an application token when it has a username or token, else an
     * OAuth client.
     *
     * @param  array<mixed>  $config
     */
    private function credentials(#[\SensitiveParameter] array $config, string $connection): Credentials
    {
        $baseUrl = $this->setting($config, 'base_url') ?? throw new InvalidArgumentException("$connection needs a base_url.");

        if ($this->setting($config, 'username') !== null || $this->setting($config, 'application_token') !== null) {
            return Credentials::applicationToken(
                $baseUrl,
                $this->setting($config, 'username') ?? throw new InvalidArgumentException("$connection needs a username."),
                $this->setting($config, 'application_token') ?? throw new InvalidArgumentException("$connection needs an application_token."),
            );
        }

        if ($this->setting($config, 'client_id') !== null || $this->setting($config, 'client_secret') !== null) {
            return Credentials::oauth(
                $baseUrl,
                $this->setting($config, 'client_id') ?? throw new InvalidArgumentException("$connection needs a client_id."),
                $this->setting($config, 'client_secret') ?? throw new InvalidArgumentException("$connection needs a client_secret."),
            );
        }

        throw new InvalidArgumentException("$connection needs a username and application_token, or a client_id and client_secret.");
    }

    /**
     * @param  array<mixed>  $config
     */
    private function setting(#[\SensitiveParameter] array $config, string $key): ?string
    {
        return is_string($config[$key] ?? null) && $config[$key] !== '' ? $config[$key] : null;
    }
}
