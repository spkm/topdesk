<?php

use spkm\Topdesk\Facades\Topdesk;
use spkm\Topdesk\Resources\HasResources;
use spkm\Topdesk\Resources\IncidentsResource;
use spkm\Topdesk\Tests\Helpers\FakeTopdesk;
use spkm\Topdesk\TopdeskConnector;
use spkm\Topdesk\TopdeskService;

function facadeDocblock(): string
{
    return (string) (new ReflectionClass(Topdesk::class))->getDocComment();
}

it('documents every resource on the facade', function () {
    $accessors = (new ReflectionClass(HasResources::class))->getMethods(ReflectionMethod::IS_PUBLIC);
    $docblock = facadeDocblock();

    foreach ($accessors as $method) {
        $returns = $method->getReturnType();

        expect($returns)->toBeInstanceOf(ReflectionNamedType::class)
            ->and($docblock)->toContain('@method static \\'.$returns->getName().' '.$method->getName().'()');
    }

    preg_match_all('/@method static \\\\spkm\\\\Topdesk\\\\Resources\\\\/', $docblock, $documented);

    expect($accessors)->not->toBeEmpty()
        ->and($documented[0])->toHaveCount(count($accessors));
});

it('documents the connector\'s own calls on the facade, each of which exists', function () {
    $docblock = facadeDocblock();

    foreach (['connector', 'connection', 'asPerson', 'send', 'paginate', 'from', 'get', 'post', 'put', 'patch', 'delete', 'baseUrl', 'forgetToken'] as $name) {
        expect($docblock)->toMatch('/@method static \S+ '.$name.'\(/');
    }

    preg_match_all('/@method static .*? (\w+)\(/', $docblock, $methods);

    foreach ($methods[1] as $name) {
        expect(method_exists(TopdeskService::class, $name) || method_exists(TopdeskConnector::class, $name))->toBeTrue("Topdesk::$name() is documented but does not exist");
    }
});

it('reaches the default server\'s resources through the facade', function () {
    config()->set('topdesk.base_url', FakeTopdesk::BASE_URL.'/tas/');
    config()->set('topdesk.username', 'api-operator');
    config()->set('topdesk.application_token', 'application-token');

    expect(Topdesk::incidents())->toBeInstanceOf(IncidentsResource::class)
        ->and(Topdesk::incidents()->connector())->toBe(Topdesk::connector())
        ->and(Topdesk::baseUrl())->toBe(FakeTopdesk::BASE_URL)
        ->and(Topdesk::baseUrl().'/tas/secure/incident?unid=abc')->toBe('https://example.topdesk.test/tas/secure/incident?unid=abc');
});
