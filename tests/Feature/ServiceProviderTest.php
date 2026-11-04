<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Saloon\Http\Faking\MockResponse;
use spkm\Topdesk\Facades\Topdesk;
use spkm\Topdesk\Requests\Login\GetLoginPersonRequest;
use spkm\Topdesk\Requests\OAuth\CreateOAuthTokenRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleItemRequest;
use spkm\Topdesk\Tests\Helpers\FakeTopdesk;
use spkm\Topdesk\TopdeskConnector;
use spkm\Topdesk\TopdeskService;
use spkm\Topdesk\TopdeskServiceProvider;

/**
 * @param  array<string, mixed>  $settings
 */
function configureTopdesk(array $settings): void
{
    foreach (['base_url', 'username', 'application_token', 'client_id', 'client_secret'] as $key) {
        config()->set("topdesk.$key", $settings[$key] ?? null);
    }
}

it('binds the service as a singleton behind the facade', function () {
    expect(app('topdesk'))->toBeInstanceOf(TopdeskService::class)
        ->and(app('topdesk'))->toBe(app('topdesk'))
        ->and(Topdesk::getFacadeRoot())->toBe(app('topdesk'));
});

it('loads the config with its environment names', function () {
    expect(config('topdesk'))->toHaveKeys(['base_url', 'username', 'application_token', 'client_id', 'client_secret', 'connections', 'timeouts', 'retries', 'reauthenticate', 'person_token_seconds', 'cache', 'pagination'])
        ->and(config('topdesk.pagination.per_page'))->toBe(100)
        ->and(config('topdesk.reauthenticate'))->toBeTrue()
        ->and(config('topdesk.person_token_seconds'))->toBe(1200)
        ->and(config('topdesk.connections'))->toBe([])
        ->and(config('topdesk.cache.enabled'))->toBeFalse()
        ->and(file_get_contents(__DIR__.'/../../config/topdesk.php'))->toContain(
            "env('TOPDESK_BASE_URL')",
            "env('TOPDESK_USERNAME')",
            "env('TOPDESK_APPLICATION_TOKEN')",
            "env('TOPDESK_CLIENT_ID')",
            "env('TOPDESK_CLIENT_SECRET')",
            "env('TOPDESK_CONNECT_TIMEOUT', 10)",
            "env('TOPDESK_REQUEST_TIMEOUT', 30)",
            "env('TOPDESK_RETRIES')",
            "env('TOPDESK_CACHE', false)",
            "env('TOPDESK_CACHE_STORE')",
        );
});

it('registers the install command and the config to publish', function () {
    $paths = ServiceProvider::pathsToPublish(TopdeskServiceProvider::class, 'topdesk-config');

    expect(Artisan::all())->toHaveKey('topdesk:install')
        ->and($paths)->toHaveCount(1)
        ->and(realpath((string) array_key_first($paths)))->toBe(realpath(__DIR__.'/../../config/topdesk.php'))
        ->and(array_values($paths)[0])->toBe(config_path('topdesk.php'));
});

it('signs the default connection in with an application token when one is configured', function () {
    configureTopdesk(['base_url' => 'https://example.topdesk.test/tas/', 'username' => 'api-operator', 'application_token' => 'application-token', 'client_id' => 'ignored', 'client_secret' => 'ignored']);
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '1'])]);

    Topdesk::send(new ExampleItemRequest(1));

    expect(Topdesk::connector()->credentials()->identity())->toBe('operator:api-operator')
        ->and(Topdesk::baseUrl())->toBe(FakeTopdesk::BASE_URL)
        ->and(FakeTopdesk::urisReceived($mockClient, ExampleItemRequest::class))->toBe([FakeTopdesk::API_URL.'/examples/id/1'])
        ->and(FakeTopdesk::authorizationsReceived($mockClient, ExampleItemRequest::class))->toBe(['Basic '.base64_encode('api-operator:application-token')]);
});

it('signs the default connection in as an OAuth client when no application token is configured', function () {
    configureTopdesk(['base_url' => FakeTopdesk::BASE_URL, 'client_id' => 'client-id', 'client_secret' => 'client-secret']);
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '1'])]);

    Topdesk::send(new ExampleItemRequest(1));

    expect(Topdesk::connector()->credentials()->identity())->toBe('client:client-id')
        ->and(FakeTopdesk::responsesTo($mockClient, CreateOAuthTokenRequest::class))->toHaveCount(1)
        ->and(FakeTopdesk::authorizationsReceived($mockClient, ExampleItemRequest::class))->toBe(['Bearer fake-oauth-token']);
});

it('signs in as a person on the default server, or on a named one', function () {
    configureTopdesk(['base_url' => FakeTopdesk::BASE_URL, 'username' => 'api-operator', 'application_token' => 'application-token']);
    config()->set('topdesk.connections.other', ['base_url' => 'https://other.topdesk.test', 'username' => 'other', 'application_token' => 'token']);
    $mockClient = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '1'])]);

    $person = Topdesk::asPerson('jsmith', 'person-password');
    $person->send(new ExampleItemRequest(1));

    expect($person)->toBeInstanceOf(TopdeskConnector::class)
        ->and($person->credentials()->identity())->toBe('person:jsmith')
        ->and($person->baseUrl())->toBe(FakeTopdesk::BASE_URL)
        ->and(Topdesk::asPerson('jsmith', 'person-password', 'other')->baseUrl())->toBe('https://other.topdesk.test')
        ->and(FakeTopdesk::responsesTo($mockClient, GetLoginPersonRequest::class))->toHaveCount(1)
        ->and(FakeTopdesk::authorizationsReceived($mockClient, ExampleItemRequest::class))->toBe(['TOKEN id="fake-person-token"']);
});

it('says which setting the default connection is missing', function (array $settings, string $message) {
    configureTopdesk($settings);

    expect(fn () => Topdesk::connector())->toThrow(InvalidArgumentException::class, $message);
})->with([
    'no address' => [['username' => 'operator', 'application_token' => 'token'], 'The default TOPdesk connection needs a base_url.'],
    'a username without a token' => [['base_url' => FakeTopdesk::BASE_URL, 'username' => 'operator'], 'The default TOPdesk connection needs an application_token.'],
    'a token without a username' => [['base_url' => FakeTopdesk::BASE_URL, 'application_token' => 'token'], 'The default TOPdesk connection needs a username.'],
    'a client id without a secret' => [['base_url' => FakeTopdesk::BASE_URL, 'client_id' => 'id'], 'The default TOPdesk connection needs a client_secret.'],
    'a client secret without an id' => [['base_url' => FakeTopdesk::BASE_URL, 'client_secret' => 'secret'], 'The default TOPdesk connection needs a client_id.'],
    'no credentials' => [['base_url' => FakeTopdesk::BASE_URL], 'The default TOPdesk connection needs a username and application_token, or a client_id and client_secret.'],
]);

it('gives a named connection its own connector, once', function () {
    config()->set('topdesk.connections.other', ['base_url' => 'https://other.topdesk.test/tas/api', 'username' => 'other-operator', 'application_token' => 'token']);

    $connection = Topdesk::connection('other');

    expect($connection)->toBeInstanceOf(TopdeskConnector::class)
        ->and($connection->resolveBaseUrl())->toBe('https://other.topdesk.test')
        ->and($connection->credentials()->identity())->toBe('operator:other-operator')
        ->and(Topdesk::connection('other'))->toBe($connection)
        ->and(Topdesk::connector('other'))->toBe($connection);
});

it('says what a named connection is missing, or that there is no such connection', function () {
    config()->set('topdesk.connections.broken', ['base_url' => 'https://other.topdesk.test', 'client_id' => 'id']);

    expect(fn () => Topdesk::connection('broken'))->toThrow(InvalidArgumentException::class, 'The TOPdesk connection "broken" needs a client_secret.')
        ->and(fn () => Topdesk::connection('nope'))->toThrow(InvalidArgumentException::class, 'No TOPdesk connection named "nope" is configured in topdesk.connections.')
        ->and(fn () => Topdesk::asPerson('jsmith', 'pw', 'nope'))->toThrow(InvalidArgumentException::class, 'No TOPdesk connection named "nope" is configured in topdesk.connections.');
});

it('builds the default connector once, the first time it is used', function () {
    configureTopdesk(['base_url' => FakeTopdesk::BASE_URL, 'username' => 'api-operator', 'application_token' => 'application-token']);

    expect(Topdesk::connector())->toBe(Topdesk::connector());
});

it('refuses a method the connector does not have', function () {
    configureTopdesk(['base_url' => FakeTopdesk::BASE_URL, 'username' => 'api-operator', 'application_token' => 'application-token']);

    expect(fn () => Topdesk::nope())->toThrow(BadMethodCallException::class, 'Method nope does not exist.');
});
