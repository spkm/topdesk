<?php

namespace spkm\Topdesk\Tests\Helpers;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\PendingRequest;
use Saloon\Http\Request;
use Saloon\Http\Response;
use spkm\Topdesk\Auth\Credentials;
use spkm\Topdesk\Requests\Login\GetLoginPersonRequest;
use spkm\Topdesk\Requests\OAuth\CreateOAuthTokenRequest;
use spkm\Topdesk\TopdeskConnector;

class FakeTopdesk
{
    public const BASE_URL = 'https://example.topdesk.test';

    public const API_URL = 'https://example.topdesk.test/tas/api';

    /**
     * Fake TOPdesk: each request class (or URL pattern) answers with the given response. Unless told otherwise,
     * TOPdesk also hands out a token to a person and to an OAuth client.
     *
     * @param  array<class-string<Request>|string, MockResponse|callable(PendingRequest): MockResponse>  $responses
     */
    public static function respondWith(array $responses = [], bool $withTokens = true): MockClient
    {
        MockClient::destroyGlobal();

        $tokens = $withTokens ? [
            GetLoginPersonRequest::class => self::personToken(),
            CreateOAuthTokenRequest::class => self::oauthToken(),
        ] : [];

        return MockClient::global([...$tokens, ...$responses]);
    }

    /**
     * A connector signed in as an operator with an application token, as most integrations are.
     */
    public static function connector(string $baseUrl = self::BASE_URL): TopdeskConnector
    {
        return new TopdeskConnector(Credentials::applicationToken($baseUrl, 'api-operator', 'application-token'));
    }

    /**
     * A connector signed in as a person (a self-service portal user), with the token TOPdesk gives them.
     */
    public static function person(string $baseUrl = self::BASE_URL): TopdeskConnector
    {
        return new TopdeskConnector(Credentials::person($baseUrl, 'jsmith', 'person-password'));
    }

    /**
     * A connector signed in as an OAuth client.
     */
    public static function oauthClient(string $baseUrl = self::BASE_URL): TopdeskConnector
    {
        return new TopdeskConnector(Credentials::oauth($baseUrl, 'client-id', 'client-secret'));
    }

    /**
     * TOPdesk's answer to GET /tas/api/login/person: the token, as a JSON string.
     */
    public static function personToken(string $token = 'fake-person-token'): MockResponse
    {
        return MockResponse::make(json_encode($token), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * TOPdesk's answer to POST /oauth/token: an access token that lasts $seconds.
     */
    public static function oauthToken(string $token = 'fake-oauth-token', int $seconds = 3600): MockResponse
    {
        return MockResponse::make(['access_token' => $token, 'token_type' => 'Bearer', 'expires_in' => $seconds]);
    }

    /**
     * A page of a list as most of TOPdesk's lists send one: a JSON array, with 206 Partial Content when more
     * records follow it and 200 OK when it is the last.
     *
     * @param  list<array<string, mixed>>  $records
     */
    public static function page(array $records, bool $more = false): MockResponse
    {
        return MockResponse::make($records, $more ? 206 : 200);
    }

    /**
     * TOPdesk's answer to a list with nothing in it: 204 No Content.
     */
    public static function noContent(): MockResponse
    {
        return MockResponse::make('', 204);
    }

    /**
     * TOPdesk's answer to a failed request in its newer APIs: {"errors": [{"errorCode", "errorMessage",
     * "appliesTo"}]}.
     *
     * @param  list<string>  $appliesTo
     */
    public static function problem(int $status, string $message, string $code = 'invalid_value', array $appliesTo = []): MockResponse
    {
        return MockResponse::make(['errors' => [['errorCode' => $code, 'errorMessage' => $message, 'appliesTo' => $appliesTo]]], $status);
    }

    /**
     * TOPdesk's answer to a failed request in its older APIs, such as incidents: a list of {"message"}.
     */
    public static function message(int $status, string $message): MockResponse
    {
        return MockResponse::make([['message' => $message]], $status);
    }

    /**
     * Send one request through an operator's connector to a faked TOPdesk that answers it with the given body.
     *
     * @param  array<mixed>|string  $body
     * @param  array<string, string>  $headers
     */
    public static function send(Request $request, array|string $body = [], int $status = 200, array $headers = []): Response
    {
        self::respondWith([$request::class => MockResponse::make($body, $status, $headers)]);

        return self::connector()->send($request);
    }

    /**
     * The request TOPdesk received for the given request class, as Saloon built it.
     *
     * @param  class-string<Request>  $requestClass
     */
    public static function received(MockClient $mockClient, string $requestClass): PendingRequest
    {
        return $mockClient->findResponseByRequest($requestClass)->getPendingRequest();
    }

    /**
     * The responses TOPdesk gave to every request of the given class, in the order they were sent.
     *
     * @param  class-string<Request>  $requestClass
     * @return list<Response>
     */
    public static function responsesTo(MockClient $mockClient, string $requestClass): array
    {
        return collect($mockClient->getRecordedResponses())
            ->filter(fn (Response $response) => $response->getRequest() instanceof $requestClass)
            ->values()
            ->all();
    }

    /**
     * The query strings TOPdesk received for every request of the given class, as sent on the wire.
     *
     * @param  class-string<Request>  $requestClass
     * @return list<string>
     */
    public static function queriesReceived(MockClient $mockClient, string $requestClass): array
    {
        return array_map(fn (Response $response) => urldecode($response->getPsrRequest()->getUri()->getQuery()), self::responsesTo($mockClient, $requestClass));
    }

    /**
     * The URIs TOPdesk received for every request of the given class, as sent on the wire.
     *
     * @param  class-string<Request>  $requestClass
     * @return list<string>
     */
    public static function urisReceived(MockClient $mockClient, string $requestClass): array
    {
        return array_map(fn (Response $response) => (string) $response->getPsrRequest()->getUri(), self::responsesTo($mockClient, $requestClass));
    }

    /**
     * The bodies TOPdesk received for every request of the given class, as sent on the wire.
     *
     * @param  class-string<Request>  $requestClass
     * @return list<string>
     */
    public static function bodiesReceived(MockClient $mockClient, string $requestClass): array
    {
        return array_map(fn (Response $response) => (string) $response->getPsrRequest()->getBody(), self::responsesTo($mockClient, $requestClass));
    }

    /**
     * A header TOPdesk received with every request of the given class.
     *
     * @param  class-string<Request>  $requestClass
     * @return list<string>
     */
    public static function headersReceived(MockClient $mockClient, string $requestClass, string $header): array
    {
        return array_map(fn (Response $response) => $response->getPsrRequest()->getHeaderLine($header), self::responsesTo($mockClient, $requestClass));
    }

    /**
     * The Authorization header TOPdesk received with every request of the given class.
     *
     * @param  class-string<Request>  $requestClass
     * @return list<string>
     */
    public static function authorizationsReceived(MockClient $mockClient, string $requestClass): array
    {
        return self::headersReceived($mockClient, $requestClass, 'Authorization');
    }
}
