<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Saloon\Config;
use Saloon\Enums\Method;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;
use spkm\Topdesk\Auth\Credentials;
use spkm\Topdesk\Exceptions\ServerErrorException;
use spkm\Topdesk\Exceptions\UnauthorizedException;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\AdhocRequest;
use spkm\Topdesk\Requests\Login\GetLoginPersonRequest;
use spkm\Topdesk\Requests\OAuth\CreateOAuthTokenRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleCreateRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleItemRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleListRequest;
use spkm\Topdesk\Tests\Helpers\FakeTopdesk;
use spkm\Topdesk\TopdeskConnector;

function tokenCacheKey(string $identity, string $baseUrl = FakeTopdesk::BASE_URL): string
{
    return 'topdesk.token.'.sha1($baseUrl.'|'.$identity);
}

it('talks to TOPdesk at the server address, however the address is written', function (string $address) {
    $connector = FakeTopdesk::connector($address);

    expect($connector->resolveBaseUrl())->toBe('https://example.topdesk.test')
        ->and($connector->baseUrl())->toBe('https://example.topdesk.test');
})->with([
    'https://example.topdesk.test',
    'https://example.topdesk.test/',
    'https://example.topdesk.test/tas',
    'https://example.topdesk.test/tas/',
    'https://example.topdesk.test/tas/api',
    'https://example.topdesk.test/tas/api/',
]);

it('contacts nobody when a connector is built', function () {
    $mockClient = FakeTopdesk::respondWith();

    FakeTopdesk::connector();
    FakeTopdesk::person();
    FakeTopdesk::oauthClient();

    expect($mockClient->getRecordedResponses())->toBe([]);
});

it('signs in as an operator with an application token over basic auth, asking for JSON', function () {
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '7'])]);

    FakeTopdesk::connector()->send(new ExampleItemRequest(7));

    expect(FakeTopdesk::urisReceived($mockClient, ExampleItemRequest::class))->toBe([FakeTopdesk::API_URL.'/examples/id/7'])
        ->and(FakeTopdesk::authorizationsReceived($mockClient, ExampleItemRequest::class))->toBe(['Basic '.base64_encode('api-operator:application-token')])
        ->and(FakeTopdesk::headersReceived($mockClient, ExampleItemRequest::class, 'Accept'))->toBe(['application/json'])
        ->and(FakeTopdesk::responsesTo($mockClient, GetLoginPersonRequest::class))->toBe([])
        ->and(FakeTopdesk::responsesTo($mockClient, CreateOAuthTokenRequest::class))->toBe([]);
});

it('signs in as a person with their password, then sends the token TOPdesk gives them', function () {
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '7'])]);

    FakeTopdesk::person()->send(new ExampleItemRequest(7));

    expect(FakeTopdesk::urisReceived($mockClient, GetLoginPersonRequest::class))->toBe([FakeTopdesk::API_URL.'/login/person'])
        ->and(FakeTopdesk::received($mockClient, GetLoginPersonRequest::class)->getMethod()->value)->toBe('GET')
        ->and(FakeTopdesk::authorizationsReceived($mockClient, GetLoginPersonRequest::class))->toBe(['Basic '.base64_encode('jsmith:person-password')])
        ->and(FakeTopdesk::authorizationsReceived($mockClient, ExampleItemRequest::class))->toBe(['TOKEN id="fake-person-token"']);
});

it('reads a person token TOPdesk sends as plain text', function () {
    $mockClient = FakeTopdesk::respondWith([
        GetLoginPersonRequest::class => MockResponse::make('plain-token', 200, ['Content-Type' => 'text/plain']),
        ExampleItemRequest::class => MockResponse::make(['id' => '7']),
    ]);

    FakeTopdesk::person()->send(new ExampleItemRequest(7));

    expect(FakeTopdesk::authorizationsReceived($mockClient, ExampleItemRequest::class))->toBe(['TOKEN id="plain-token"']);
});

it('signs in as an OAuth client by the client credentials grant, then sends the access token as a bearer token', function () {
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '7'])]);

    FakeTopdesk::oauthClient()->send(new ExampleItemRequest(7));

    parse_str(FakeTopdesk::bodiesReceived($mockClient, CreateOAuthTokenRequest::class)[0], $form);

    expect(FakeTopdesk::urisReceived($mockClient, CreateOAuthTokenRequest::class))->toBe([FakeTopdesk::BASE_URL.'/oauth/token'])
        ->and($form)->toBe(['grant_type' => 'client_credentials'])
        ->and(FakeTopdesk::headersReceived($mockClient, CreateOAuthTokenRequest::class, 'Content-Type'))->toBe(['application/x-www-form-urlencoded'])
        ->and(FakeTopdesk::authorizationsReceived($mockClient, CreateOAuthTokenRequest::class))->toBe(['Basic '.base64_encode('client-id:client-secret')])
        ->and(FakeTopdesk::authorizationsReceived($mockClient, ExampleItemRequest::class))->toBe(['Bearer fake-oauth-token']);
});

it('caches a token encrypted and shares it with other connectors for the same server and sign-in', function () {
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '7'])]);

    FakeTopdesk::person()->send(new ExampleItemRequest(7));
    FakeTopdesk::person()->send(new ExampleItemRequest(8));

    $cached = Cache::get(tokenCacheKey('person:jsmith'));
    $token = json_decode(Crypt::decryptString($cached), true);

    expect(FakeTopdesk::responsesTo($mockClient, GetLoginPersonRequest::class))->toHaveCount(1)
        ->and($cached)->toBeString()->not->toContain('fake-person-token')
        ->and($token['token'])->toBe('fake-person-token')
        ->and(FakeTopdesk::authorizationsReceived($mockClient, ExampleItemRequest::class))->toBe(['TOKEN id="fake-person-token"', 'TOKEN id="fake-person-token"']);
});

it('keeps a separate token for each sign-in and server', function () {
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '7'])]);

    FakeTopdesk::person()->send(new ExampleItemRequest(7));
    FakeTopdesk::oauthClient()->send(new ExampleItemRequest(7));
    FakeTopdesk::person('https://other.topdesk.test')->send(new ExampleItemRequest(7));
    (new TopdeskConnector(Credentials::person(FakeTopdesk::BASE_URL, 'someone-else', 'pw')))->send(new ExampleItemRequest(7));

    expect(FakeTopdesk::responsesTo($mockClient, GetLoginPersonRequest::class))->toHaveCount(3)
        ->and(FakeTopdesk::responsesTo($mockClient, CreateOAuthTokenRequest::class))->toHaveCount(1)
        ->and(Cache::has(tokenCacheKey('client:client-id')))->toBeTrue()
        ->and(Cache::has(tokenCacheKey('person:someone-else')))->toBeTrue()
        ->and(Cache::has(tokenCacheKey('person:jsmith', 'https://other.topdesk.test')))->toBeTrue();
});

it('keeps a person token for as long as config says, then fetches another', function () {
    config()->set('topdesk.person_token_seconds', 600);
    Carbon::setTestNow('2026-11-04 09:00:00');
    $mockClient = FakeTopdesk::respondWith([
        GetLoginPersonRequest::class => fn () => FakeTopdesk::personToken(),
        ExampleItemRequest::class => MockResponse::make(['id' => '7']),
    ]);
    $connector = FakeTopdesk::person();

    $connector->send(new ExampleItemRequest(7));
    Carbon::setTestNow('2026-11-04 09:08:59');
    $connector->send(new ExampleItemRequest(7));
    expect(FakeTopdesk::responsesTo($mockClient, GetLoginPersonRequest::class))->toHaveCount(1);

    Carbon::setTestNow('2026-11-04 09:09:00');
    $connector->send(new ExampleItemRequest(7));
    expect(FakeTopdesk::responsesTo($mockClient, GetLoginPersonRequest::class))->toHaveCount(2);
});

it('replaces an OAuth token a minute before it expires, or halfway through a short life', function () {
    Carbon::setTestNow('2026-11-04 09:00:00');
    $mockClient = FakeTopdesk::respondWith([
        CreateOAuthTokenRequest::class => fn () => FakeTopdesk::oauthToken(seconds: 60),
        ExampleItemRequest::class => MockResponse::make(['id' => '7']),
    ]);
    $connector = FakeTopdesk::oauthClient();

    $connector->send(new ExampleItemRequest(7));
    $token = json_decode(Crypt::decryptString(Cache::get(tokenCacheKey('client:client-id'))), true);
    Carbon::setTestNow('2026-11-04 09:00:29');
    $connector->send(new ExampleItemRequest(7));
    expect(FakeTopdesk::responsesTo($mockClient, CreateOAuthTokenRequest::class))->toHaveCount(1);

    Carbon::setTestNow('2026-11-04 09:00:30');
    $connector->send(new ExampleItemRequest(7));

    expect($token['refresh_at'])->toBe($token['expires_at'] - 30)
        ->and(FakeTopdesk::responsesTo($mockClient, CreateOAuthTokenRequest::class))->toHaveCount(2);
});

it('fetches a new token and sends the request again, once, when TOPdesk answers 401', function () {
    $tokens = 0;
    $answers = 0;
    $mockClient = FakeTopdesk::respondWith([
        GetLoginPersonRequest::class => function () use (&$tokens) {
            return FakeTopdesk::personToken('token-'.++$tokens);
        },
        ExampleItemRequest::class => function () use (&$answers) {
            return ++$answers === 1 ? MockResponse::make('<html><title>401</title></html>', 401, ['Content-Type' => 'text/html']) : MockResponse::make(['id' => '7']);
        },
    ]);

    $response = FakeTopdesk::person()->send(new ExampleItemRequest(7));

    expect($response->status())->toBe(200)
        ->and(FakeTopdesk::authorizationsReceived($mockClient, ExampleItemRequest::class))->toBe(['TOKEN id="token-1"', 'TOKEN id="token-2"'])
        ->and(FakeTopdesk::responsesTo($mockClient, GetLoginPersonRequest::class))->toHaveCount(2);
});

it('gives up after one more try when TOPdesk keeps answering 401', function () {
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make([], 401)]);

    $response = FakeTopdesk::oauthClient()->send(new ExampleItemRequest(7));

    expect($response->status())->toBe(401)
        ->and(FakeTopdesk::responsesTo($mockClient, ExampleItemRequest::class))->toHaveCount(2);
});

it('returns a 401 to an application token as it is, since there is no token to fetch again', function () {
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make([], 401)]);

    $response = FakeTopdesk::connector()->send(new ExampleItemRequest(7));

    expect($response->status())->toBe(401)
        ->and(FakeTopdesk::responsesTo($mockClient, ExampleItemRequest::class))->toHaveCount(1);
});

it('returns a 401 as it is when told not to sign in again', function () {
    config()->set('topdesk.reauthenticate', false);
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make([], 401)]);

    $response = FakeTopdesk::person()->send(new ExampleItemRequest(7));

    expect($response->status())->toBe(401)
        ->and(FakeTopdesk::responsesTo($mockClient, ExampleItemRequest::class))->toHaveCount(1)
        ->and(FakeTopdesk::responsesTo($mockClient, GetLoginPersonRequest::class))->toHaveCount(1);
});

it('says why TOPdesk refused to sign in', function () {
    FakeTopdesk::respondWith([CreateOAuthTokenRequest::class => MockResponse::make(['error' => 'invalid_client', 'error_description' => 'Client authentication failed'], 401)]);

    expect(fn () => FakeTopdesk::oauthClient()->send(new ExampleItemRequest(7)))
        ->toThrow(UnauthorizedException::class, 'TOPdesk responded 401 to POST /oauth/token: Client authentication failed');
});

it('forgets its token when asked, and fetches another for the next request', function () {
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '7'])]);
    $connector = FakeTopdesk::person();

    $connector->send(new ExampleItemRequest(7));
    $connector->forgetToken();

    expect(Cache::has(tokenCacheKey('person:jsmith')))->toBeFalse()
        ->and($connector->getAuthenticator())->toBeNull();

    $connector->send(new ExampleItemRequest(7));

    expect(FakeTopdesk::responsesTo($mockClient, GetLoginPersonRequest::class))->toHaveCount(2);
});

it('ignores a cached token it cannot decrypt', function () {
    Cache::put(tokenCacheKey('person:jsmith'), 'not-encrypted', 600);
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '7'])]);

    FakeTopdesk::person()->send(new ExampleItemRequest(7));

    expect(FakeTopdesk::responsesTo($mockClient, GetLoginPersonRequest::class))->toHaveCount(1)
        ->and(FakeTopdesk::authorizationsReceived($mockClient, ExampleItemRequest::class))->toBe(['TOKEN id="fake-person-token"']);
});

it('keeps secrets and tokens out of dumps', function () {
    FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '7'])]);
    $connector = FakeTopdesk::person();

    expect($connector->__debugInfo())->toBe(['baseUrl' => FakeTopdesk::BASE_URL, 'identity' => 'person:jsmith', 'token' => null]);

    $connector->send(new ExampleItemRequest(7));
    ob_start();
    var_dump($connector, $connector->credentials(), FakeTopdesk::connector(), FakeTopdesk::oauthClient()->credentials());
    $dump = (string) ob_get_clean();

    expect($connector->__debugInfo()['token'])->toBe('[redacted]')
        ->and($dump)->not->toContain('person-password')
        ->and($dump)->not->toContain('application-token')
        ->and($dump)->not->toContain('client-secret')
        ->and($dump)->not->toContain('fake-person-token')
        ->and($dump)->toContain('[redacted]');
});

it('refuses to serialise a connector or credentials', function () {
    expect(fn () => serialize(FakeTopdesk::connector()))->toThrow(LogicException::class, 'A TOPdesk connector cannot be serialised')
        ->and(fn () => serialize(Credentials::person(FakeTopdesk::BASE_URL, 'u', 'p')))->toThrow(LogicException::class, 'TOPdesk credentials cannot be serialised');
});

it('checks credentials as they are built', function () {
    $operator = Credentials::applicationToken(FakeTopdesk::BASE_URL.'/tas/', 'operator', 'secret');
    $person = Credentials::person(FakeTopdesk::BASE_URL, 'jsmith', 'secret');
    $client = Credentials::oauth(FakeTopdesk::BASE_URL, 'client-id', 'secret');

    expect($operator->identity())->toBe('operator:operator')
        ->and($operator->baseUrl)->toBe(FakeTopdesk::BASE_URL)
        ->and($operator->usesToken())->toBeFalse()
        ->and($person->identity())->toBe('person:jsmith')
        ->and($person->usesToken())->toBeTrue()
        ->and($client->identity())->toBe('client:client-id')
        ->and($client->usesToken())->toBeTrue()
        ->and(fn () => Credentials::applicationToken(' ', 'operator', 'secret'))->toThrow(InvalidArgumentException::class, "TOPdesk credentials need the server's address.")
        ->and(fn () => Credentials::applicationToken(FakeTopdesk::BASE_URL, '', 'secret'))->toThrow(InvalidArgumentException::class, 'An application token needs the operator\'s login name and the token.')
        ->and(fn () => Credentials::applicationToken(FakeTopdesk::BASE_URL, 'operator', ''))->toThrow(InvalidArgumentException::class, 'An application token needs the operator\'s login name and the token.')
        ->and(fn () => Credentials::person(FakeTopdesk::BASE_URL, '', 'secret'))->toThrow(InvalidArgumentException::class, 'A person needs a login name and a password.')
        ->and(fn () => Credentials::oauth(FakeTopdesk::BASE_URL, 'id', ''))->toThrow(InvalidArgumentException::class, 'An OAuth client needs a client id and a client secret.');
});

it('takes its timeouts and retries from config', function () {
    config()->set('topdesk.timeouts', ['connect' => 3, 'request' => 7]);
    config()->set('topdesk.retries', ['times' => 3, 'interval_ms' => 1]);
    $connector = FakeTopdesk::connector();

    expect($connector->getConnectTimeout())->toBe(3.0)
        ->and($connector->getRequestTimeout())->toBe(7.0)
        ->and($connector->tries)->toBe(3)
        ->and($connector->retryInterval)->toBe(1)
        ->and($connector->useExponentialBackoff)->toBeTrue()
        ->and($connector->throwOnMaxTries)->toBeFalse();
});

it('falls back to the default timeouts when config gives none, zero or nonsense', function (mixed $value) {
    config()->set('topdesk.timeouts', ['connect' => $value, 'request' => $value]);
    $connector = FakeTopdesk::connector();

    expect($connector->getConnectTimeout())->toBe((float) Config::$defaultConnectionTimeout)
        ->and($connector->getRequestTimeout())->toBe((float) Config::$defaultRequestTimeout)
        ->and($connector->tries)->toBeNull();
})->with([null, 0, -5, 'abc']);

it('retries a GET, not a write, on a server error, a timeout or too many requests', function (int $status) {
    config()->set('topdesk.retries', ['times' => 3, 'interval_ms' => 1]);
    $mockClient = FakeTopdesk::respondWith([
        ExampleItemRequest::class => MockResponse::make([], $status),
        ExampleCreateRequest::class => MockResponse::make([], $status),
    ]);
    $connector = FakeTopdesk::connector();

    $connector->send(new ExampleItemRequest(1));
    $connector->send(new ExampleCreateRequest(['name' => 'x']));

    expect(FakeTopdesk::responsesTo($mockClient, ExampleItemRequest::class))->toHaveCount(3)
        ->and(FakeTopdesk::responsesTo($mockClient, ExampleCreateRequest::class))->toHaveCount(1);
})->with([500, 503, 408, 429]);

it('does not retry a GET that TOPdesk refused', function () {
    config()->set('topdesk.retries', ['times' => 3, 'interval_ms' => 1]);
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make([], 404)]);

    $response = FakeTopdesk::connector()->send(new ExampleItemRequest(1));

    expect($response->status())->toBe(404)
        ->and(FakeTopdesk::responsesTo($mockClient, ExampleItemRequest::class))->toHaveCount(1);
});

it('retries a GET, not a write, when the connection fails', function () {
    FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make([])]);
    $connector = FakeTopdesk::connector();
    $fatal = new FatalRequestException(new RuntimeException('down'), $connector->createPendingRequest(new ExampleItemRequest(1)));

    expect($connector->handleRetry($fatal, new ExampleItemRequest(1)))->toBeTrue()
        ->and($connector->handleRetry($fatal, new ExampleCreateRequest([])))->toBeFalse()
        ->and($connector->handleRetry($fatal, new AdhocRequest(Method::GET, 'incidents')))->toBeTrue()
        ->and($connector->handleRetry($fatal, new AdhocRequest(Method::DELETE, 'incidents')))->toBeFalse();
});

it('repeats a parameter with several values', function () {
    $mockClient = FakeTopdesk::respondWith([
        ExampleListRequest::class => FakeTopdesk::page([]),
        AdhocRequest::class => MockResponse::make([]),
    ]);

    FakeTopdesk::connector()->send(new ExampleListRequest(Query::make()->with('status', ['firstLine', 'secondLine'])));
    FakeTopdesk::connector()->get('changeCalendar?keep=a=b', ['cardType' => ['change', 'activity'], 'flag' => true]);

    expect(FakeTopdesk::queriesReceived($mockClient, ExampleListRequest::class))->toBe(['status=firstLine&status=secondLine'])
        ->and(FakeTopdesk::queriesReceived($mockClient, AdhocRequest::class))->toBe(['keep=a=b&cardType=change&cardType=activity&flag=true']);
});

it('makes ad-hoc calls by method and path, under /tas/api unless the path names another root', function () {
    $mockClient = FakeTopdesk::respondWith([FakeTopdesk::BASE_URL.'/*' => MockResponse::make(['id' => '9'])]);
    $connector = FakeTopdesk::connector();

    $responses = [
        $connector->get('incidents', ['pageSize' => 2]),
        $connector->post('/incidents', ['briefDescription' => 'Broken screen']),
        $connector->put('incidents/id/9', ['request' => 'More detail']),
        $connector->patch('/tas/api/incidents/number/I 2401 001', ['action' => 'Fixed']),
        $connector->delete('incidents/id/9/actions/3'),
        $connector->get('/services/knowledge-base-v1/knowledgeItems'),
        $connector->get('/tas/api/assetmgmt/assets'),
    ];
    $sent = collect($mockClient->getRecordedResponses())
        ->map(fn (Response $response) => [
            $response->getPsrRequest()->getMethod(),
            (string) $response->getPsrRequest()->getUri(),
            (string) $response->getPsrRequest()->getBody(),
        ])
        ->values()
        ->all();

    expect($responses[0]->json())->toBe(['id' => '9'])
        ->and($sent)->toBe([
            ['GET', FakeTopdesk::API_URL.'/incidents?pageSize=2', ''],
            ['POST', FakeTopdesk::API_URL.'/incidents', '{"briefDescription":"Broken screen"}'],
            ['PUT', FakeTopdesk::API_URL.'/incidents/id/9', '{"request":"More detail"}'],
            ['PATCH', FakeTopdesk::API_URL.'/incidents/number/I%202401%20001', '{"action":"Fixed"}'],
            ['DELETE', FakeTopdesk::API_URL.'/incidents/id/9/actions/3', ''],
            ['GET', FakeTopdesk::BASE_URL.'/services/knowledge-base-v1/knowledgeItems', ''],
            ['GET', FakeTopdesk::API_URL.'/assetmgmt/assets', ''],
        ]);
});

it('refuses a path that would leave the endpoint it names', function () {
    FakeTopdesk::respondWith([AdhocRequest::class => MockResponse::make([])]);

    expect(fn () => FakeTopdesk::connector()->get('incidents/../secret'))->toThrow(InvalidArgumentException::class, 'is not a path TOPdesk serves')
        ->and(fn () => (new ExampleItemRequest('..'))->resolveEndpoint())->toThrow(InvalidArgumentException::class, 'cannot be used in a request path')
        ->and(fn () => (new ExampleItemRequest(''))->resolveEndpoint())->toThrow(InvalidArgumentException::class)
        ->and((new ExampleItemRequest('a/b c'))->resolveEndpoint())->toBe('/tas/api/examples/id/a%2Fb%20c');
});

it('treats a sign-in answer without a token as TOPdesk failing', function (Closure $connector, string $request, MockResponse $answer) {
    FakeTopdesk::respondWith([$request => $answer, ExampleItemRequest::class => MockResponse::make(['id' => '7'])]);

    expect(fn () => $connector()->send(new ExampleItemRequest(7)))->toThrow(ServerErrorException::class, 'TOPdesk responded 200');
})->with([
    'a person, given an empty token' => [fn () => FakeTopdesk::person(), GetLoginPersonRequest::class, MockResponse::make('""')],
    'a person, given something other than a token' => [fn () => FakeTopdesk::person(), GetLoginPersonRequest::class, MockResponse::make(['token' => 'x'])],
    'an OAuth client, given no access token' => [fn () => FakeTopdesk::oauthClient(), CreateOAuthTokenRequest::class, MockResponse::make(['token_type' => 'Bearer'])],
]);

it('keeps the password and client secret out of a token request\'s dump', function () {
    ob_start();
    var_dump(new GetLoginPersonRequest('jsmith', 'person-password'), new CreateOAuthTokenRequest('client-id', 'client-secret'));
    $dump = (string) ob_get_clean();

    expect($dump)->toContain('jsmith', 'client-id', '[redacted]')
        ->and($dump)->not->toContain('person-password')
        ->and($dump)->not->toContain('client-secret');
});
