<?php

use spkm\Topdesk\Facades\Topdesk;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Resources\BaseResource;
use spkm\Topdesk\Resources\HasResources;
use spkm\Topdesk\Tests\Helpers\FakeTopdesk;

$endpoints = require __DIR__.'/endpoints.php';
$listed = array_map(fn (array $row) => $row[0], $endpoints);

/**
 * @return list<string>
 */
function resourceAccessors(): array
{
    return array_map(fn (ReflectionMethod $method) => $method->getName(), (new ReflectionClass(HasResources::class))->getMethods(ReflectionMethod::IS_PUBLIC));
}

it('gives a resource for every group of endpoints', function () {
    expect(resourceAccessors())->toHaveCount(85);

    foreach (resourceAccessors() as $accessor) {
        expect(FakeTopdesk::connector()->{$accessor}())->toBeInstanceOf(BaseResource::class);
    }
});

it('lists a collection resource with a listed request', function () use ($listed) {
    $builders = 0;

    foreach (resourceAccessors() as $accessor) {
        $resource = FakeTopdesk::connector()->{$accessor}();

        if ($resource instanceof Builder) {
            $builders++;
            expect(in_array($resource->toRequest()::class, $listed, true))->toBeTrue("$accessor() lists with an unlisted request");
        }
    }

    expect($builders)->toBeGreaterThan(40);
});

it('reaches every resource through the facade and documents it and each of its methods', function () {
    config()->set('topdesk.base_url', FakeTopdesk::BASE_URL);
    config()->set('topdesk.username', 'api-operator');
    config()->set('topdesk.application_token', 'application-token');
    $markdown = file_get_contents(__DIR__.'/../../ENDPOINTS.md');

    foreach (resourceAccessors() as $accessor) {
        $resource = Topdesk::{$accessor}();

        expect($resource)->toBeInstanceOf(FakeTopdesk::connector()->{$accessor}()::class)
            ->and($markdown)->toContain("Topdesk::{$accessor}()");

        foreach ((new ReflectionClass($resource))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getDeclaringClass()->getName() === $resource::class && ! $method->isConstructor()) {
                expect($markdown)->toContain('`'.ucfirst($method->getName()).'Request`');
            }
        }
    }
});

it('uses every request from some resource', function () use ($listed) {
    $used = [];

    foreach (glob(__DIR__.'/../../src/Resources/*Resource.php') as $file) {
        preg_match_all('/^use (spkm\\\\Topdesk\\\\Requests\\\\[^;]+);/m', (string) file_get_contents($file), $matches);
        $used = [...$used, ...$matches[1]];
    }

    expect(array_values(array_diff($listed, $used)))->toBe([]);
});
