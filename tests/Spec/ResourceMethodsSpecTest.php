<?php

use Illuminate\Support\Collection;
use Saloon\Http\Faking\MockResponse;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Resources\BaseResource;
use spkm\Topdesk\Resources\HasResources;
use spkm\Topdesk\Resources\PagedResource;
use spkm\Topdesk\Tests\Helpers\FakeTopdesk;

/*
 * Every method a generated resource offers, called once against a faked TOPdesk that answers everything with a
 * list of one record: each must send a request and give back what its return type promises.
 */

function resourceArgument(ReflectionParameter $parameter): mixed
{
    $type = $parameter->getType();
    $name = $type instanceof ReflectionNamedType ? $type->getName() : (string) $type;

    return match (true) {
        $parameter->isDefaultValueAvailable() => $parameter->getDefaultValue(),
        $name === 'int' => 7,
        $name === 'string' => 'sample',
        $name === 'bool' => true,
        str_contains($name, 'array') => [],
        str_contains($name, 'Query') => Query::make(),
        default => 'sample',
    };
}

function checkResourceReturn(ReflectionMethod $method, mixed $result): void
{
    $type = $method->getReturnType();
    $name = $type instanceof ReflectionNamedType ? $type->getName() : 'mixed';

    match (true) {
        $name === 'bool' => expect($result)->toBeTrue(),
        $name === Collection::class => expect($result)->toBeInstanceOf(Collection::class),
        $name === 'string' => expect($result)->toBeString(),
        is_subclass_of($name, Data::class) => expect($result)->toBeInstanceOf($name),
        $name === PagedResource::class => expect($result)->toBeInstanceOf(PagedResource::class),
        default => expect(true)->toBeTrue(),
    };
}

/**
 * Call every method a resource declares (and, for a builder, what it inherits), counting the calls.
 */
function exerciseResource(BaseResource $resource): int
{
    $calls = 0;

    foreach ((new ReflectionClass($resource))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
        if ($method->getDeclaringClass()->getName() !== $resource::class || $method->isConstructor()) {
            continue;
        }

        $result = $resource->{$method->getName()}(...array_map(resourceArgument(...), $method->getParameters()));
        checkResourceReturn($method, $result);
        $calls++;

        if ($result instanceof Builder) {
            expect($result->limit(1)->get())->toBeInstanceOf(Collection::class)
                ->and($result->all())->toHaveCount(1);
            $calls += 2;
        }
    }

    if ($resource instanceof Builder) {
        expect($resource->limit(1)->get())->toBeInstanceOf(Collection::class)
            ->and($resource->first())->not->toBeNull()
            ->and($resource->count())->toBe(1);

        foreach (['find' => [7], 'create' => [[]], 'update' => [7, []], 'delete' => [7]] as $action => $arguments) {
            try {
                $resource->{$action}(...$arguments);
                $calls++;
            } catch (LogicException $exception) {
                expect($exception->getMessage())->toContain("no way to $action");
            }
        }
    }

    return $calls;
}

$accessors = array_map(fn (ReflectionMethod $method) => [$method->getName()], (new ReflectionClass(HasResources::class))->getMethods(ReflectionMethod::IS_PUBLIC));

it('answers every method of every resource', function (string $accessor) {
    $mockClient = FakeTopdesk::respondWith([FakeTopdesk::BASE_URL.'/*' => MockResponse::make([['id' => '7', 'name' => 'x']])]);

    expect(exerciseResource(FakeTopdesk::connector()->{$accessor}()))->toBeGreaterThan(0)
        ->and($mockClient->getRecordedResponses())->not->toBeEmpty();
})->with($accessors);
