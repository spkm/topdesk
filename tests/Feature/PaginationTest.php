<?php

use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\PendingRequest;
use spkm\Topdesk\Exceptions\ServerErrorException;
use spkm\Topdesk\Requests\AdhocListRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleData;
use spkm\Topdesk\Tests\Fixtures\ExampleListRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleUnfilteredListRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleUnlimitedListRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleUnpagedListRequest;
use spkm\Topdesk\Tests\Helpers\FakeTopdesk;
use spkm\Topdesk\TopdeskPaginator;

/**
 * A faked list of $total records that answers each page by its offset and size parameters, as TOPdesk does: 206
 * Partial Content while more records follow, 200 OK for the last page, and 204 No Content past the end.
 */
function paginatorPages(int $total, string $offset = 'pageStart', string $size = 'pageSize'): Closure
{
    return function (PendingRequest $request) use ($total, $offset, $size): MockResponse {
        $start = (int) $request->query()->get($offset, 0);
        $count = (int) $request->query()->get($size, 10);
        $records = [];

        for ($id = $start + 1; $id <= min($total, $start + $count); $id++) {
            $records[] = ['id' => (string) $id, 'name' => "Incident $id"];
        }

        if ($records === []) {
            return FakeTopdesk::noContent();
        }

        return FakeTopdesk::page($records, more: $start + $count < $total);
    };
}

it('pages from an offset of 0 with the configured page size until TOPdesk says it has sent the last page', function () {
    config()->set('topdesk.pagination.per_page', 2);
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => paginatorPages(5)]);

    $items = FakeTopdesk::connector()->paginate(new ExampleListRequest)->collect()->all();

    expect(array_column($items, 'id'))->toBe(['1', '2', '3', '4', '5'])
        ->and(FakeTopdesk::queriesReceived($mock, ExampleListRequest::class))->toBe([
            'pageStart=0&pageSize=2',
            'pageStart=2&pageSize=2',
            'pageStart=4&pageSize=2',
        ]);
});

it('pages with the parameters each endpoint takes', function () {
    $mock = FakeTopdesk::respondWith([ExampleUnfilteredListRequest::class => paginatorPages(3, 'start', 'page_size')]);

    $items = FakeTopdesk::connector()->paginate(new ExampleUnfilteredListRequest, 2)->collect()->all();

    expect($items)->toHaveCount(3)
        ->and(FakeTopdesk::queriesReceived($mock, ExampleUnfilteredListRequest::class))->toBe([
            'start=0&page_size=2',
            'start=2&page_size=2',
        ]);
});

it('asks once, for as many records as the endpoint allows, of a list that takes no offset', function () {
    $mock = FakeTopdesk::respondWith([ExampleUnpagedListRequest::class => FakeTopdesk::page([['id' => '1'], ['id' => '2']], more: true)]);

    $items = FakeTopdesk::connector()->paginate(new ExampleUnpagedListRequest, 2)->collect()->all();

    expect($items)->toHaveCount(2)
        ->and(FakeTopdesk::queriesReceived($mock, ExampleUnpagedListRequest::class))->toBe(['$top=10000']);
});

it('takes the page size it is given over the configured one', function () {
    config()->set('topdesk.pagination.per_page', 2);
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => paginatorPages(3)]);

    FakeTopdesk::connector()->paginate(new ExampleListRequest, 10)->collect()->all();

    expect(FakeTopdesk::queriesReceived($mock, ExampleListRequest::class))->toBe(['pageStart=0&pageSize=10']);
});

it('keeps the page size between 1 and the endpoint\'s limit', function (int $asked, int $sent) {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::page([])]);

    FakeTopdesk::connector()->paginate(new ExampleListRequest, $asked)->collect()->all();

    expect(FakeTopdesk::queriesReceived($mock, ExampleListRequest::class))->toBe(["pageStart=0&pageSize=$sent"]);
})->with([[5000, 1000], [0, 1], [-3, 1], [1000, 1000]]);

it('stops at a 200, even when the page is full', function () {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::page([['id' => '1'], ['id' => '2']])]);

    $items = FakeTopdesk::connector()->paginate(new ExampleListRequest, 2)->collect()->all();

    expect($items)->toHaveCount(2)
        ->and(FakeTopdesk::responsesTo($mock, ExampleListRequest::class))->toHaveCount(1);
});

it('keeps going after a 200 that links to a next page', function () {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => function (PendingRequest $request) {
        return (int) $request->query()->get('pageStart') === 0
            ? MockResponse::make(['results' => [['id' => '1'], ['id' => '2']], 'next' => '/tas/api/operatorChanges?pageStart=2'])
            : MockResponse::make(['results' => [['id' => '3']], 'next' => null]);
    }]);

    $items = FakeTopdesk::connector()->paginate(new ExampleListRequest, 2)->collect()->all();

    expect(array_column($items, 'id'))->toBe(['1', '2', '3'])
        ->and(FakeTopdesk::responsesTo($mock, ExampleListRequest::class))->toHaveCount(2);
});

it('stops once it has as many records as the total TOPdesk gives', function () {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => function (PendingRequest $request) {
        $start = (int) $request->query()->get('pageStart');

        return MockResponse::make(['total' => 3, 'results' => $start === 0 ? [['id' => '1'], ['id' => '2']] : [['id' => '3']]]);
    }]);

    $items = FakeTopdesk::connector()->paginate(new ExampleListRequest, 2)->collect()->all();

    expect($items)->toHaveCount(3)
        ->and(FakeTopdesk::responsesTo($mock, ExampleListRequest::class))->toHaveCount(2);
});

it('stops at an empty page or a 204', function (MockResponse $response) {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => $response]);

    expect(FakeTopdesk::connector()->paginate(new ExampleListRequest, 2)->collect()->all())->toBe([])
        ->and(FakeTopdesk::responsesTo($mock, ExampleListRequest::class))->toHaveCount(1);
})->with([
    'empty list' => fn () => MockResponse::make([], 206),
    'no content' => fn () => FakeTopdesk::noContent(),
]);

it('stops when an endpoint ignores the offset and answers the same records again', function () {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::page([['id' => '1'], ['id' => '2']], more: true)]);

    $items = FakeTopdesk::connector()->paginate(new ExampleListRequest, 2)->collect()->all();

    expect(array_column($items, 'id'))->toBe(['1', '2'])
        ->and(FakeTopdesk::responsesTo($mock, ExampleListRequest::class))->toHaveCount(2);
});

it('reads the records out of the wrappers TOPdesk puts lists in', function (array $body) {
    FakeTopdesk::respondWith([ExampleListRequest::class => MockResponse::make($body)]);

    $items = FakeTopdesk::connector()->paginate(new ExampleListRequest, 10)->collect()->all();

    expect(array_column($items, 'id'))->toBe(['1', '2']);
})->with([
    'results' => [['results' => [['id' => '1'], ['id' => '2']]]],
    'item' => [['item' => [['id' => '1'], ['id' => '2']], 'prev' => null, 'next' => null]],
    'dataSet' => [['dataSet' => [['id' => '1'], ['id' => '2']], 'count' => 2]],
]);

it('gives the records as the request\'s models, or as any model', function () {
    FakeTopdesk::respondWith([ExampleListRequest::class => paginatorPages(3)]);
    $paginator = FakeTopdesk::connector()->paginate(new ExampleListRequest, 2);

    $dtos = $paginator->dtos()->all();
    $models = FakeTopdesk::connector()->paginate(new ExampleListRequest, 2)->models(ExampleData::class)->all();

    expect($dtos)->toHaveCount(3)
        ->and($dtos[2])->toBeInstanceOf(ExampleData::class)
        ->and($dtos[2]->name)->toBe('Incident 3')
        ->and($models[0])->toBeInstanceOf(ExampleData::class);
});

it('refuses to give models for a request that has none', function () {
    FakeTopdesk::respondWith([AdhocListRequest::class => FakeTopdesk::page([])]);

    FakeTopdesk::connector()->paginate(new AdhocListRequest('things'))->dtos();
})->throws(LogicException::class, 'AdhocListRequest has no model');

function paginatorFailingSecondPage(): Closure
{
    return function (PendingRequest $request) {
        return (int) $request->query()->get('pageStart') === 0
            ? FakeTopdesk::page([['id' => '1'], ['id' => '2']], more: true)
            : FakeTopdesk::message(500, 'Database unavailable');
    };
}

it('throws when a page fails part way through', function () {
    FakeTopdesk::respondWith([ExampleListRequest::class => paginatorFailingSecondPage()]);

    try {
        FakeTopdesk::connector()->paginate(new ExampleListRequest, 2)->collect()->all();
        $this->fail('The failed page was not reported.');
    } catch (RequestException $exception) {
        expect($exception->getResponse()->status())->toBe(500);
    }
});

it('throws TOPdesk\'s own exception when a page fails part way through', function () {
    FakeTopdesk::respondWith([ExampleListRequest::class => paginatorFailingSecondPage()]);

    FakeTopdesk::connector()->paginate(new ExampleListRequest, 2)->collect()->all();
})->throws(ServerErrorException::class, 'Database unavailable');

it('pages through an ad-hoc list with its own query kept', function () {
    $mock = FakeTopdesk::respondWith([FakeTopdesk::API_URL.'/incidents*' => paginatorPages(3)]);

    $items = FakeTopdesk::connector()->paginate(new AdhocListRequest('incidents', ['sort' => 'callDate:asc']), 2)->collect()->all();

    expect($items)->toHaveCount(3)
        ->and($items[0])->toBe(['id' => '1', 'name' => 'Incident 1'])
        ->and(FakeTopdesk::queriesReceived($mock, AdhocListRequest::class))->toBe([
            'sort=callDate:asc&pageStart=0&pageSize=2',
            'sort=callDate:asc&pageStart=2&pageSize=2',
        ]);
});

it('is a paginator', function () {
    expect(FakeTopdesk::connector()->paginate(new ExampleListRequest))->toBeInstanceOf(TopdeskPaginator::class);
});

it('asks once, without a size, for a list that takes no offset and documents no limit', function () {
    $mock = FakeTopdesk::respondWith([ExampleUnlimitedListRequest::class => FakeTopdesk::page([['id' => '1'], ['id' => '2'], ['id' => '3']])]);

    $items = FakeTopdesk::connector()->paginate(new ExampleUnlimitedListRequest, 2)->collect()->all();

    expect($items)->toHaveCount(3)
        ->and(FakeTopdesk::queriesReceived($mock, ExampleUnlimitedListRequest::class))->toBe(['']);
});
