<?php

use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use Saloon\Enums\Method;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\PendingRequest;
use spkm\Topdesk\Exceptions\NotFoundException;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Filter;
use spkm\Topdesk\Query\Operator;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\AdhocBodyRequest;
use spkm\Topdesk\Requests\AdhocListRequest;
use spkm\Topdesk\Requests\AdhocRequest;
use spkm\Topdesk\Resources\PagedResource;
use spkm\Topdesk\Tests\Fixtures\ExampleCreateRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleData;
use spkm\Topdesk\Tests\Fixtures\ExampleDeleteRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleItemRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleListRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleReadOnlyResource;
use spkm\Topdesk\Tests\Fixtures\ExampleResource;
use spkm\Topdesk\Tests\Fixtures\ExampleUnfilteredListRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleUnlimitedListRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleUnpagedListRequest;
use spkm\Topdesk\Tests\Fixtures\ExampleUpdateRequest;
use spkm\Topdesk\Tests\Helpers\FakeTopdesk;
use spkm\Topdesk\TopdeskPaginator;

function exampleBuilder(): ExampleResource
{
    return new ExampleResource(FakeTopdesk::connector());
}

/**
 * The query string the builder sends for one page of what it was told.
 */
function builderQueryFor(Closure $build): string
{
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::page([['id' => '1']])]);

    $build(exampleBuilder())->limit(10)->get();

    return FakeTopdesk::queriesReceived($mock, ExampleListRequest::class)[0];
}

/**
 * A faked list of $total records that answers each page by its pageStart and pageSize parameters.
 */
function builderPagesOf(int $total): Closure
{
    return function (PendingRequest $request) use ($total): MockResponse {
        $start = (int) $request->query()->get('pageStart', 0);
        $size = (int) $request->query()->get('pageSize', 10);
        $records = [];

        for ($id = $start + 1; $id <= min($total, $start + $size); $id++) {
            $records[] = ['id' => (string) $id, 'name' => "Incident $id"];
        }

        return $records === [] ? FakeTopdesk::noContent() : FakeTopdesk::page($records, more: $start + $size < $total);
    };
}

it('sends a condition as a FIQL query', function (Closure $build, string $filter) {
    expect(builderQueryFor($build))->toBe("query=$filter&pageSize=10");
})->with([
    'equal' => [fn (Builder $q) => $q->where('caller.dynamicName', 'Jo Bloggs'), 'caller.dynamicName=="Jo Bloggs"'],
    'greater than' => [fn (Builder $q) => $q->where('number', '>', 5), 'number=gt=5'],
    '= as ==' => [fn (Builder $q) => $q->where('number', '=', 5), 'number==5'],
    '<> as !=' => [fn (Builder $q) => $q->where('briefDescription', '<>', 'Printer*'), 'briefDescription!=Printer*'],
    'in' => [fn (Builder $q) => $q->where('number', 'in', [1, 2]), 'number=in=(1,2)'],
    'not in' => [fn (Builder $q) => $q->where('number', 'not in', [3]), 'number=out=(3)'],
    '=lt=' => [fn (Builder $q) => $q->where('number', '=lt=', 9), 'number=lt=9'],
    'an Operator' => [fn (Builder $q) => $q->where('number', Operator::GreaterOrEqual, 4), 'number=ge=4'],
    'two ANDed' => [fn (Builder $q) => $q->where('number', '>', 5)->where('closed', false), 'number=gt=5;closed==false'],
    'whereNot' => [fn (Builder $q) => $q->whereNot('status', 'firstLine'), 'status!=firstLine'],
    'whereIn' => [fn (Builder $q) => $q->whereIn('processingStatus.name', ['Open', 'On hold']), 'processingStatus.name=in=(Open,"On hold")'],
    'whereNotIn' => [fn (Builder $q) => $q->whereNotIn('number', collect([7, 8])), 'number=out=(7,8)'],
    'whereBetween' => [fn (Builder $q) => $q->whereBetween('number', [10, 20]), 'number=ge=10;number=le=20'],
    'whereNull' => [fn (Builder $q) => $q->whereNull('operator'), 'operator==null'],
    'whereNotNull' => [fn (Builder $q) => $q->whereNotNull('operator'), 'operator!=null'],
    'whereStartsWith' => [fn (Builder $q) => $q->whereStartsWith('briefDescription', 'iPad'), 'briefDescription=sw=iPad'],
    'whereContains' => [fn (Builder $q) => $q->whereContains('briefDescription', 'screen'), 'briefDescription==*screen*'],
    'orWhere' => [fn (Builder $q) => $q->where('number', 1)->orWhere('number', 2), 'number==1,number==2'],
    'orWhere with an operator' => [fn (Builder $q) => $q->where('number', 1)->orWhere('number', '>', 100), 'number==1,number=gt=100'],
    'orWhere a group' => [fn (Builder $q) => $q->where('closed', true)->orWhere(fn (Builder $g) => $g->where('number', 1)->where('status', 'x')), 'closed==true,(number==1;status==x)'],
    'where a group' => [fn (Builder $q) => $q->where('closed', true)->where(fn (Builder $g) => $g->where('number', 1)->orWhere('number', 2)), 'closed==true;(number==1,number==2)'],
    'AND after OR' => [fn (Builder $q) => $q->where('number', 1)->orWhere('number', 2)->where('closed', true), '(number==1,number==2);closed==true'],
]);

it('sends the fields, the sort and other parameters', function () {
    $query = builderQueryFor(fn (Builder $q) => $q->select('id', 'number')->orderBy('callDate')->orderByDesc('number')->withParameter('dateFormat', 'iso8601'));

    expect($query)->toBe('dateFormat=iso8601&fields=id,number&sort=callDate:asc,number:desc&pageSize=10');
});

it('takes the fields as a list too', function () {
    expect(builderQueryFor(fn (Builder $q) => $q->select(['id', 'caller'])))->toBe('fields=id,caller&pageSize=10');
});

it('sends one page for forPage(), counting pages from 1 as Laravel does, and an offset for skip()', function () {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::page([['id' => '51']], more: true)]);

    $records = exampleBuilder()->forPage(2, 50)->get();
    exampleBuilder()->skip(30)->limit(10)->get();

    expect($records->first()->id)->toBe('51')
        ->and(FakeTopdesk::queriesReceived($mock, ExampleListRequest::class))->toBe(['pageStart=50&pageSize=50', 'pageStart=30&pageSize=10']);
});

it('keeps a limit to the endpoint\'s largest page', function () {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::page([])]);

    exampleBuilder()->limit(5000)->get();

    expect(FakeTopdesk::queriesReceived($mock, ExampleListRequest::class))->toBe(['pageSize=1000']);
});

it('gets every matching record, a page at a time, when not told how many', function () {
    config()->set('topdesk.pagination.per_page', 2);
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => builderPagesOf(5)]);

    $records = exampleBuilder()->where('closed', false)->get();

    expect($records)->toBeInstanceOf(Collection::class)
        ->and($records)->toHaveCount(5)
        ->and($records->every(fn ($record) => $record instanceof ExampleData))->toBeTrue()
        ->and(FakeTopdesk::queriesReceived($mock, ExampleListRequest::class))->toBe([
            'query=closed==false&pageStart=0&pageSize=2',
            'query=closed==false&pageStart=2&pageSize=2',
            'query=closed==false&pageStart=4&pageSize=2',
        ]);
});

it('gets every record with all(), lazy() and cursor()', function () {
    FakeTopdesk::respondWith([ExampleListRequest::class => builderPagesOf(3)]);

    expect(exampleBuilder()->all(2))->toHaveCount(3)
        ->and(exampleBuilder()->lazy(2))->toBeInstanceOf(LazyCollection::class)
        ->and(exampleBuilder()->lazy(2)->map(fn (ExampleData $record) => $record->id)->all())->toBe(['1', '2', '3'])
        ->and(exampleBuilder()->cursor(2)->count())->toBe(3);
});

it('gives no records for a 204', function () {
    FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::noContent()]);

    expect(exampleBuilder()->get())->toHaveCount(0)
        ->and(exampleBuilder()->limit(5)->get())->toHaveCount(0)
        ->and(exampleBuilder()->first())->toBeNull();
});

it('gives a paginator over the matching records, paging with the limit when one was set', function () {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => builderPagesOf(3)]);

    $paginator = exampleBuilder()->where('closed', false)->limit(2)->paginate();

    expect($paginator)->toBeInstanceOf(TopdeskPaginator::class)
        ->and($paginator->collect()->all())->toHaveCount(3)
        ->and(FakeTopdesk::queriesReceived($mock, ExampleListRequest::class)[0])->toBe('query=closed==false&pageStart=0&pageSize=2');
});

it('gets the first record with a page of one', function () {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::page([['id' => '9', 'name' => 'First']], more: true)]);

    $record = exampleBuilder()->orderBy('name')->first();

    expect($record)->toBeInstanceOf(ExampleData::class)
        ->and($record->name)->toBe('First')
        ->and(FakeTopdesk::queriesReceived($mock, ExampleListRequest::class))->toBe(['sort=name:asc&pageStart=0&pageSize=1']);
});

it('counts the matching records by fetching only their ids', function () {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => builderPagesOf(5)]);

    expect(exampleBuilder()->where('closed', false)->count())->toBe(5)
        ->and(FakeTopdesk::queriesReceived($mock, ExampleListRequest::class)[0])->toBe('query=closed==false&fields=id&pageStart=0&pageSize=1000');
});

it('says whether anything matches from a page of one', function () {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::page([['id' => '1']], more: true)]);

    expect(exampleBuilder()->where('closed', false)->exists())->toBeTrue()
        ->and(FakeTopdesk::queriesReceived($mock, ExampleListRequest::class))->toBe(['query=closed==false&pageStart=0&pageSize=1']);

    FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::noContent()]);

    expect(exampleBuilder()->exists())->toBeFalse();
});

it('fetches a list that takes no offset in one go, as much of it as the endpoint allows', function () {
    $mock = FakeTopdesk::respondWith([ExampleUnpagedListRequest::class => FakeTopdesk::page([['id' => '1'], ['id' => '2']])]);
    $lookups = fn () => new PagedResource(FakeTopdesk::connector(), ExampleData::class, fn (Query $query) => new ExampleUnpagedListRequest($query));

    expect($lookups()->where('name', 'x')->select('id')->get())->toHaveCount(2)
        ->and($lookups()->limit(1)->get())->toHaveCount(2)
        ->and(FakeTopdesk::queriesReceived($mock, ExampleUnpagedListRequest::class))->toBe(['query=name==x&$fields=id&$top=10000', '$top=1']);
});

it('finds a record by id with the collection\'s item request', function () {
    $mock = FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '7', 'name' => 'Broken screen'])]);

    $record = exampleBuilder()->find(7);

    expect($record)->toBeInstanceOf(ExampleData::class)
        ->and($record->name)->toBe('Broken screen')
        ->and(FakeTopdesk::urisReceived($mock, ExampleItemRequest::class))->toBe([FakeTopdesk::API_URL.'/examples/id/7']);
});

it('gives null for a record TOPdesk does not have, and findOrFail() throws', function () {
    FakeTopdesk::respondWith([ExampleItemRequest::class => FakeTopdesk::message(404, 'Incident not found')]);

    expect(exampleBuilder()->find(404))->toBeNull();

    exampleBuilder()->findOrFail(404);
})->throws(NotFoundException::class, 'Incident not found');

it('gives the record from findOrFail() when TOPdesk has it', function () {
    FakeTopdesk::respondWith([ExampleItemRequest::class => MockResponse::make(['id' => '7'])]);

    expect(exampleBuilder()->findOrFail('7')->id)->toBe('7');
});

it('finds a record by filtering on its id when the collection has no item request', function () {
    $mock = FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::page([['id' => '7']])]);
    $paged = new PagedResource(FakeTopdesk::connector(), ExampleData::class, fn (Query $query) => new ExampleListRequest($query));

    expect($paged->find(7)->id)->toBe('7')
        ->and($paged->findOrFail(7)->id)->toBe('7')
        ->and(FakeTopdesk::queriesReceived($mock, ExampleListRequest::class)[0])->toBe('query=id==7&pageStart=0&pageSize=1');
});

it('throws when filtering on its id finds nothing for findOrFail()', function () {
    FakeTopdesk::respondWith([ExampleListRequest::class => FakeTopdesk::noContent()]);
    $paged = new PagedResource(FakeTopdesk::connector(), ExampleData::class, fn (Query $query) => new ExampleListRequest($query));

    expect($paged->find(7))->toBeNull();

    $paged->findOrFail(7);
})->throws(NotFoundException::class);

it('creates, updates and deletes with the collection\'s requests', function () {
    $mock = FakeTopdesk::respondWith([
        ExampleCreateRequest::class => MockResponse::make(['id' => '12', 'number' => 'I 2611 001'], 201),
        ExampleUpdateRequest::class => MockResponse::make(['id' => '12', 'name' => 'Renamed']),
        ExampleDeleteRequest::class => MockResponse::make('', 204),
    ]);

    $created = exampleBuilder()->create(['name' => 'New']);
    $updated = exampleBuilder()->update(12, new ExampleData(name: 'Renamed', password: 'secret'));
    $deleted = exampleBuilder()->delete(12);

    expect($created)->toBe(['id' => '12', 'number' => 'I 2611 001'])
        ->and($updated)->toBeInstanceOf(ExampleData::class)
        ->and($updated->name)->toBe('Renamed')
        ->and($deleted)->toBeTrue()
        ->and(FakeTopdesk::bodiesReceived($mock, ExampleCreateRequest::class))->toBe(['{"name":"New"}'])
        ->and(FakeTopdesk::bodiesReceived($mock, ExampleUpdateRequest::class))->toBe(['{"name":"Renamed"}'])
        ->and(FakeTopdesk::received($mock, ExampleUpdateRequest::class)->getMethod())->toBe(Method::PATCH)
        ->and(FakeTopdesk::urisReceived($mock, ExampleDeleteRequest::class))->toBe([FakeTopdesk::API_URL.'/examples/id/12']);
});

it('refuses what the endpoint does not take, rather than letting TOPdesk ignore it', function (Closure $build, string $message) {
    FakeTopdesk::respondWith([]);

    $build(new ExampleReadOnlyResource(FakeTopdesk::connector()));
})->with([
    'a filter' => [fn (Builder $q) => $q->where('id', 1)->get(), 'takes no filter'],
    'a sort' => [fn (Builder $q) => $q->orderBy('id')->limit(5)->get(), 'takes no sort'],
    'fields' => [fn (Builder $q) => $q->select('id')->first(), 'takes no fields'],
    'a filter when paging' => [fn (Builder $q) => $q->where('id', 1)->paginate(), 'takes no filter'],
    'creating' => [fn (Builder $q) => $q->create(['name' => 'x']), 'no way to create'],
    'updating' => [fn (Builder $q) => $q->update(1, ['name' => 'x']), 'no way to update'],
    'deleting' => [fn (Builder $q) => $q->delete(1), 'no way to delete'],
])->throws(LogicException::class);

it('says which endpoint refused', function () {
    (new ExampleReadOnlyResource(FakeTopdesk::connector()))->where('id', 1)->toRequest();
})->throws(LogicException::class, "TOPdesk's GET /tas/api/plain-examples takes no filter.");

it('gives what it would send', function () {
    $builder = exampleBuilder()->where('number', '>', 5)->orderBy('name')->forPage(3, 25);

    expect($builder->toArray())->toBe(['query' => 'number=gt=5', 'sort' => 'name:asc', 'pageStart' => 50, 'pageSize' => 25])
        ->and($builder->toQuery())->toBeInstanceOf(Query::class)
        ->and($builder->toFilter())->toBeInstanceOf(Filter::class)
        ->and((string) $builder->toFilter())->toBe('number=gt=5')
        ->and($builder->toRequest())->toBeInstanceOf(ExampleListRequest::class)
        ->and($builder->toRequest()->query()->all())->toBe(['query' => 'number=gt=5', 'sort' => 'name:asc', 'pageStart' => 50, 'pageSize' => 25]);
});

it('builds a query over a collection the package has no resource for', function () {
    $mock = FakeTopdesk::respondWith([
        AdhocListRequest::class => FakeTopdesk::page([['id' => '1', 'name' => 'Thing']]),
        AdhocRequest::class => fn (PendingRequest $request) => $request->getMethod() === Method::DELETE ? MockResponse::make('', 204) : MockResponse::make(['id' => '1']),
        AdhocBodyRequest::class => MockResponse::make(['id' => '2']),
    ]);
    $things = FakeTopdesk::connector()->from('things');

    expect($things->where('name', 'Thing')->limit(1)->get()->first())->toBe(['id' => '1', 'name' => 'Thing'])
        ->and(FakeTopdesk::connector()->from('things')->find(1))->toBe(['id' => '1'])
        ->and(FakeTopdesk::connector()->from('things', 'things/id/{id}')->find(1))->toBe(['id' => '1'])
        ->and(FakeTopdesk::connector()->from('things')->create(['name' => 'New']))->toBe(['id' => '2'])
        ->and(FakeTopdesk::connector()->from('things')->update(2, ['name' => 'Renamed']))->toBe(['id' => '2'])
        ->and(FakeTopdesk::connector()->from('things', updateMethod: Method::PUT)->update(2, ['name' => 'Replaced']))->toBe(['id' => '2'])
        ->and(FakeTopdesk::connector()->from('things')->delete(1))->toBeTrue();

    $writes = array_map(fn ($response) => $response->getPendingRequest()->getMethod()->value.' '.$response->getPsrRequest()->getUri()->getPath(), FakeTopdesk::responsesTo($mock, AdhocBodyRequest::class));
    $others = array_map(fn ($response) => $response->getPendingRequest()->getMethod()->value.' '.$response->getPsrRequest()->getUri()->getPath(), FakeTopdesk::responsesTo($mock, AdhocRequest::class));

    expect(FakeTopdesk::queriesReceived($mock, AdhocListRequest::class))->toBe(['query=name==Thing&pageSize=1'])
        ->and($writes)->toBe(['POST /tas/api/things', 'PATCH /tas/api/things/2', 'PUT /tas/api/things/2'])
        ->and(array_values(array_filter($others, fn ($line) => ! str_starts_with($line, 'POST') && ! str_starts_with($line, 'PATCH') && ! str_starts_with($line, 'PUT'))))->toBe(['GET /tas/api/things/1', 'GET /tas/api/things/id/1', 'DELETE /tas/api/things/1']);
});

it('sends a limit as it is to a list that documents no limit', function () {
    $mock = FakeTopdesk::respondWith([ExampleUnlimitedListRequest::class => FakeTopdesk::page([['id' => '1']])]);
    $locations = new PagedResource(FakeTopdesk::connector(), ExampleData::class, fn (Query $query) => new ExampleUnlimitedListRequest($query));

    $locations->limit(50000)->get();

    expect(FakeTopdesk::queriesReceived($mock, ExampleUnlimitedListRequest::class))->toBe(['pageSize=50000']);
});

it('finds a record by looking through the list when the collection has neither an item request nor a filter', function () {
    $mock = FakeTopdesk::respondWith([ExampleUnfilteredListRequest::class => FakeTopdesk::page([['id' => '6', 'name' => 'Lost'], ['id' => '7', 'name' => 'Stolen']])]);
    $reasons = new ExampleReadOnlyResource(FakeTopdesk::connector());

    expect($reasons->find(7)->name)->toBe('Stolen')
        ->and($reasons->find('missing'))->toBeNull()
        ->and(fn () => $reasons->findOrFail('missing'))->toThrow(NotFoundException::class)
        ->and(FakeTopdesk::queriesReceived($mock, ExampleUnfilteredListRequest::class)[0])->toBe('start=0&page_size=100');
});
