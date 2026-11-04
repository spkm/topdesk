<?php

use Illuminate\Support\Collection;
use Saloon\Contracts\Body\HasBody;
use Saloon\Http\Faking\MockResponse;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\Tests\Helpers\FakeTopdesk;

$endpoints = require __DIR__.'/endpoints.php';

it('sends the method, path and media type TOPdesk documents, and maps the response', function (string $class, array $args, string $method, string $path, string $shape, ?string $dto, bool $hasBody, bool $paginatable, ?string $accept) {
    /** @var TopdeskRequest $request */
    $request = new $class(...$args);

    expect($request)->toBeInstanceOf(TopdeskRequest::class)
        ->and($request->getMethod()->value)->toBe($method)
        ->and($request->resolveEndpoint())->toBe($path)
        ->and($request->dtoClass())->toBe($dto)
        ->and($request->responseShape())->toBe($shape)
        ->and($request->accepts())->toBe($accept)
        ->and($request instanceof Paginatable)->toBe($paginatable)
        ->and($request instanceof HasBody)->toBe($hasBody)
        ->and($request->isSafe())->toBe($method === 'GET');

    $sample = ['id' => '7', 'name' => 'x'];
    $mockClient = FakeTopdesk::respondWith([$class => match ($shape) {
        'list' => FakeTopdesk::page([$sample]),
        'one' => MockResponse::make($sample),
        'raw' => MockResponse::make(['a' => 'b']),
        'text' => MockResponse::make('FILE BYTES', 200, ['Content-Type' => 'application/octet-stream']),
        default => FakeTopdesk::noContent(),
    }], withTokens: false);
    $response = FakeTopdesk::connector()->send($request);
    $result = $response->dto();

    expect((string) $response->getPsrRequest()->getUri())->toStartWith(FakeTopdesk::BASE_URL.$path)
        ->and($response->getPsrRequest()->getHeaderLine('Accept'))->toBe($accept ?? 'application/json')
        ->and($mockClient->getRecordedResponses())->not->toBeEmpty();

    match ($shape) {
        'list' => $dto === null
            ? expect($result)->toBeInstanceOf(Collection::class)->toHaveCount(1)->and($result->first())->toBe($sample)
            : expect($result)->toBeInstanceOf(Collection::class)->toHaveCount(1)->and($result->first())->toBeInstanceOf($dto),
        'one' => $dto === null ? expect($result)->toBe($sample) : expect($result)->toBeInstanceOf($dto)->and($result)->toBeInstanceOf(Data::class),
        'raw' => expect($result)->toBe(['a' => 'b']),
        'text' => expect($result)->toBe('FILE BYTES'),
        default => expect($result)->toBeNull(),
    };
})->with($endpoints);

it('covers every operation in TOPdesk\'s REST APIs, with every request class listed once', function () use ($endpoints) {
    $classes = collect(glob(__DIR__.'/../../src/Requests/*/*Request.php'))
        ->map(fn (string $file) => 'spkm\\Topdesk\\Requests\\'.basename(dirname($file)).'\\'.basename($file, '.php'))
        ->sort()
        ->values();
    $listed = collect($endpoints)->map(fn (array $row) => $row[0])->sort()->values();

    expect($listed->all())->toBe($classes->all())
        ->and($listed->unique())->toHaveCount($listed->count())
        ->and($classes)->toHaveCount(604)
        ->and(collect($endpoints)->keys()->unique())->toHaveCount(604);
});

it('documents every request in ENDPOINTS.md', function () use ($endpoints) {
    $markdown = file_get_contents(__DIR__.'/../../ENDPOINTS.md');

    foreach ($endpoints as $operation => $row) {
        [$method, $path] = explode(' ', $operation, 2);

        expect($markdown)->toContain('`'.class_basename($row[0]).'`')
            ->and($markdown)->toContain("| $method | `$path` |");
    }
});

it('marks a request for an endpoint TOPdesk has deprecated', function () use ($endpoints) {
    $deprecated = collect($endpoints)->filter(fn (array $row) => str_contains((string) (new ReflectionClass($row[0]))->getDocComment(), '@deprecated TOPdesk deprecated this endpoint.'));

    expect($deprecated->keys()->all())->toContain('GET /tas/api/login/operator', 'GET /tas/api/overviewReservations')
        ->and($deprecated->keys()->all())->not->toContain('GET /tas/api/incidents');
});
