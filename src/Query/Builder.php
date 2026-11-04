<?php

namespace spkm\Topdesk\Query;

use BackedEnum;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use LogicException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Exceptions\NotFoundException;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\Resources\BaseResource;
use spkm\Topdesk\Support\Payload;
use spkm\Topdesk\TopdeskApiException;
use spkm\Topdesk\TopdeskConnector;
use spkm\Topdesk\TopdeskPaginator;

/**
 * An Eloquent-style query over one TOPdesk collection. Each resource extends it, saying which requests list,
 * fetch, create, update and delete its records; the builder turns where(), select(), orderBy(), skip() and
 * limit() into the filter, fields, sort and paging parameters the list request takes, and the response into
 * models.
 *
 * @template TData of Data
 *
 * @extends BaseResource<TData>
 */
abstract class Builder extends BaseResource
{
    protected Query $query;

    /**
     * @param  class-string<TData>|null  $dataClass  The model records are returned as; null for arrays.
     */
    public function __construct(TopdeskConnector $connector, ?string $dataClass)
    {
        parent::__construct($connector, $dataClass);

        $this->query = Query::make();
    }

    abstract protected function listRequest(Query $query): ListRequest;

    protected function itemRequest(int|string $id): ?TopdeskRequest
    {
        return null;
    }

    /**
     * @param  array<string, mixed>  $body
     */
    protected function createRequest(array $body): ?TopdeskRequest
    {
        return null;
    }

    /**
     * @param  array<string, mixed>  $body
     */
    protected function updateRequest(int|string $id, array $body): ?TopdeskRequest
    {
        return null;
    }

    protected function deleteRequest(int|string $id): ?TopdeskRequest
    {
        return null;
    }

    /**
     * A condition on a field: where('operatorGroup.name', 'Service Desk'), where('creationDate', '>', $date),
     * where('briefDescription', '!=', 'Test*'). Nested fields take dots; a * in a value compared with == or != is
     * a wildcard; null compares with an empty field. Conditions are ANDed.
     */
    public function where(Closure|string $field, mixed $operator = null, mixed $value = null): static
    {
        if ($field instanceof Closure) {
            $this->query = $this->query->withFilter($this->query->filter()->and($this->group($field)));

            return $this;
        }

        if (func_num_args() === 2) {
            [$operator, $value] = [Operator::Equal, $operator];
        }

        $this->query = $this->query->where($field, $operator instanceof Operator ? $operator : Operator::fromString((string) ($operator ?? '==')), $value);

        return $this;
    }

    /**
     * Everything so far, OR this: a condition (orWhere('number', 'I 2611 001')) or a group
     * (orWhere(fn ($query) => ...)).
     */
    public function orWhere(Closure|string $field, mixed $operator = null, mixed $value = null): static
    {
        if ($field instanceof Closure) {
            $this->query = $this->query->withFilter($this->query->filter()->or($this->group($field)));

            return $this;
        }

        $alternative = $this->fresh();
        func_num_args() === 2 ? $alternative->where($field, $operator) : $alternative->where($field, $operator, $value);
        $this->query = $this->query->withFilter($this->query->filter()->or($alternative->toFilter()));

        return $this;
    }

    public function whereNot(string $field, mixed $value): static
    {
        return $this->where($field, Operator::NotEqual, $value);
    }

    /**
     * @param  iterable<mixed>  $values
     */
    public function whereIn(string $field, iterable $values): static
    {
        return $this->where($field, Operator::In, $values);
    }

    /**
     * @param  iterable<mixed>  $values
     */
    public function whereNotIn(string $field, iterable $values): static
    {
        return $this->where($field, Operator::NotIn, $values);
    }

    /**
     * @param  array{mixed, mixed}  $range
     */
    public function whereBetween(string $field, array $range): static
    {
        [$from, $to] = $range;

        return $this->where($field, Operator::GreaterOrEqual, $from)->where($field, Operator::LessOrEqual, $to);
    }

    public function whereNull(string $field): static
    {
        return $this->where($field, Operator::Equal, null);
    }

    public function whereNotNull(string $field): static
    {
        return $this->where($field, Operator::NotEqual, null);
    }

    /**
     * The value starts with the given text (=sw=).
     */
    public function whereStartsWith(string $field, string $value): static
    {
        return $this->where($field, Operator::StartsWith, $value);
    }

    /**
     * The value has the given text somewhere in it: a == comparison with the text between * wildcards.
     */
    public function whereContains(string $field, string $value): static
    {
        return $this->where($field, Operator::Equal, '*'.$value.'*');
    }

    /**
     * The fields to return, such as select('id', 'number', 'caller'); TOPdesk returns them all when not told,
     * which for some collections is slow.
     *
     * @param  iterable<string>|string  ...$fields
     */
    public function select(iterable|string ...$fields): static
    {
        $flat = [];

        foreach ($fields as $field) {
            foreach (is_iterable($field) ? $field : [$field] as $item) {
                $flat[] = $item;
            }
        }

        $this->query = $this->query->select($flat);

        return $this;
    }

    public function orderBy(string $field, string $direction = 'asc'): static
    {
        $this->query = $this->query->orderBy($field, $direction);

        return $this;
    }

    public function orderByDesc(string $field): static
    {
        return $this->orderBy($field, 'desc');
    }

    /**
     * How many records to return: one request for that many (at most the endpoint's largest page).
     */
    public function limit(int $limit): static
    {
        $this->query = $this->query->limit($limit);

        return $this;
    }

    /**
     * How many records to skip.
     */
    public function skip(int $offset): static
    {
        $this->query = $this->query->offset($offset);

        return $this;
    }

    /**
     * One page of records, counting pages from 1 as Laravel does.
     */
    public function forPage(int $page, int $perPage): static
    {
        $this->query = $this->query->offset(max(0, $page - 1) * $perPage)->limit($perPage);

        return $this;
    }

    /**
     * Another query parameter the endpoint documents, such as withParameter('archived', false).
     */
    public function withParameter(string $parameter, mixed $value): static
    {
        $this->query = $this->query->with($parameter, $value instanceof BackedEnum ? $value->value : $value);

        return $this;
    }

    /**
     * The matching records: the ones limit() or forPage() asked for, or all of them.
     *
     * @return Collection<int, TData>
     */
    public function get(): Collection
    {
        if ($this->query->getLimit() === null) {
            return $this->all();
        }

        /** @var Collection<int, TData> */
        return Payload::items($this->send($this->query), $this->dataClass);
    }

    /**
     * Every matching record, fetched a page at a time.
     *
     * @return Collection<int, TData>
     */
    public function all(?int $perPage = null): Collection
    {
        return $this->lazy($perPage)->collect();
    }

    /**
     * The first matching record in sort order.
     *
     * @return TData|null
     */
    public function first(): mixed
    {
        return Payload::object($this->send($this->firstPage()), $this->dataClass);
    }

    /**
     * How many records match. TOPdesk's lists don't give a total, so this fetches every matching record's id.
     */
    public function count(): int
    {
        $query = $this->listRequest($this->query)->fieldsParameter() !== null ? $this->query->select(['id']) : $this->query;
        $builder = clone $this;
        $builder->query = $query->withoutPaging();

        return $builder->lazy($builder->listRequest($query)->maxPageSize())->count();
    }

    public function exists(): bool
    {
        return Payload::records($this->send($this->firstPage())) !== [];
    }

    /**
     * The record with the given id, or null when TOPdesk has none.
     *
     * @return TData|null
     */
    public function find(int|string $id): mixed
    {
        $request = $this->itemRequest($id);

        if ($request === null) {
            return $this->findInList($id);
        }

        return $this->fetchOrNull($request);
    }

    /**
     * The record with the given id from the list: by filtering on its id where the endpoint takes a filter, else by
     * looking through the records.
     *
     * @return TData|null
     */
    protected function findInList(int|string $id): mixed
    {
        if ($this->fresh()->listRequest(Query::make())->filterParameter() !== null) {
            return $this->fresh()->where('id', (string) $id)->first();
        }

        return $this->fresh()->lazy()->first(fn (mixed $record) => self::idOf($record) === (string) $id);
    }

    /**
     * A record's id, whether it is a model or an array; '' when it has none.
     */
    private static function idOf(mixed $record): string
    {
        $id = is_array($record) ? ($record['id'] ?? null) : (is_object($record) && isset($record->id) ? $record->id : null);

        return is_scalar($id) ? (string) $id : '';
    }

    /**
     * @return TData
     */
    public function findOrFail(int|string $id): mixed
    {
        $request = $this->itemRequest($id);

        if ($request === null) {
            $record = $this->findInList($id);

            if ($record === null) {
                throw new NotFoundException($this->send($this->fresh()->firstPage()));
            }

            return $record;
        }

        return $this->fetch($request) ?? throw new NotFoundException($this->connector->send($request));
    }

    /**
     * Every matching record, fetched a page at a time as the loop reaches it.
     *
     * @return LazyCollection<int, TData>
     */
    public function lazy(?int $perPage = null): LazyCollection
    {
        $paginator = $this->paginate($perPage);
        $dataClass = $this->dataClass;

        return LazyCollection::make(function () use ($paginator, $dataClass) {
            try {
                foreach ($dataClass === null ? $paginator->collect() : $paginator->models($dataClass) as $item) {
                    yield $item;
                }
            } catch (RequestException $exception) {
                throw $exception instanceof TopdeskApiException ? $exception : TopdeskApiException::fromResponse($exception->getResponse());
            }
        });
    }

    /**
     * @return LazyCollection<int, TData>
     */
    public function cursor(?int $perPage = null): LazyCollection
    {
        return $this->lazy($perPage);
    }

    /**
     * A paginator over the matching records, for fetching pages one at a time yourself.
     */
    public function paginate(?int $perPage = null): TopdeskPaginator
    {
        return $this->connector->paginate($this->checked($this->listRequest($this->query->withoutPaging())), $perPage ?? $this->query->getLimit());
    }

    /**
     * Create a record. TOPdesk answers with the record it stored.
     *
     * @param  array<string, mixed>|Data  $attributes
     */
    public function create(array|Data $attributes): mixed
    {
        return $this->fetch($this->createRequest($this->payloadOf($attributes)) ?? $this->undocumented('create'));
    }

    /**
     * Change a record. TOPdesk answers with the record as updated.
     *
     * @param  array<string, mixed>|Data  $attributes
     */
    public function update(int|string $id, array|Data $attributes): mixed
    {
        return $this->fetch($this->updateRequest($id, $this->payloadOf($attributes)) ?? $this->undocumented('update'));
    }

    public function delete(int|string $id): bool
    {
        $this->fetch($this->deleteRequest($id) ?? $this->undocumented('delete'));

        return true;
    }

    /**
     * The request get() would send, for sending through the connector yourself.
     */
    public function toRequest(): ListRequest
    {
        return $this->checked($this->listRequest($this->query));
    }

    public function toQuery(): Query
    {
        return $this->query;
    }

    public function toFilter(): Filter
    {
        return $this->query->filter();
    }

    /**
     * The query parameters get() would send.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->toRequest()->query()->all();
    }

    protected function send(Query $query): Response
    {
        $response = $this->connector->send($this->checked($this->listRequest($query)));

        if (! $response->successful()) {
            throw TopdeskApiException::fromResponse($response);
        }

        return $response;
    }

    /**
     * The query for the first record: from the start, one record, where the endpoint takes those.
     */
    protected function firstPage(): Query
    {
        return $this->query->offset(0)->limit(1);
    }

    /**
     * The request, refused when the query asks for what its endpoint doesn't take, rather than sent for TOPdesk to
     * ignore the filter and answer every record.
     */
    protected function checked(ListRequest $request): ListRequest
    {
        $endpoint = $request->getMethod()->value.' '.$request->resolveEndpoint();

        if (! $this->query->filter()->isEmpty() && $request->filterParameter() === null) {
            throw new LogicException("TOPdesk's $endpoint takes no filter.");
        }

        if ($this->query->getSort() !== [] && $request->sortParameter() === null) {
            throw new LogicException("TOPdesk's $endpoint takes no sort.");
        }

        if ($this->query->getFields() !== [] && $request->fieldsParameter() === null) {
            throw new LogicException("TOPdesk's $endpoint takes no fields.");
        }

        return $request;
    }

    /**
     * A copy of this builder with no conditions, for building a group or an alternative.
     */
    protected function fresh(): static
    {
        $fresh = clone $this;
        $fresh->query = Query::make();

        return $fresh;
    }

    private function group(Closure $callback): Filter
    {
        $group = $this->fresh();
        $callback($group);

        return $group->toFilter();
    }

    private function undocumented(string $action): never
    {
        throw new LogicException("TOPdesk's API documents no way to $action these records here.");
    }
}
