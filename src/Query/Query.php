<?php

namespace spkm\Topdesk\Query;

use InvalidArgumentException;
use spkm\Topdesk\Support\QueryString;
use Stringable;

/**
 * The query string of a TOPdesk list request, built up immutably: a FIQL filter, the fields to return, a sort
 * (field:asc, comma separated), the offset of the first record, how many to return, and any other parameter the
 * endpoint documents. TOPdesk's endpoints name these differently, so toArray() writes them under the names the
 * list request gives.
 */
final class Query implements Stringable
{
    private Filter $filter;

    /** @var list<string> */
    private array $fields = [];

    /** @var list<string> */
    private array $sort = [];

    private ?int $offset = null;

    private ?int $limit = null;

    /** @var array<string, mixed> */
    private array $parameters = [];

    public function __construct(?Filter $filter = null)
    {
        $this->filter = $filter ?? Filter::make();
    }

    public static function make(): self
    {
        return new self;
    }

    public function filter(): Filter
    {
        return $this->filter;
    }

    public function withFilter(Filter $filter): self
    {
        $query = clone $this;
        $query->filter = $filter;

        return $query;
    }

    /**
     * A comparison, ANDed with the ones before it.
     */
    public function where(string $field, Operator|string $operator, mixed $value = null): self
    {
        return $this->withFilter($this->filter->where($field, $operator, $value));
    }

    /**
     * The fields to return, in place of any chosen before.
     *
     * @param  iterable<string>  $fields
     */
    public function select(iterable $fields): self
    {
        $query = clone $this;
        $query->fields = [];

        foreach ($fields as $field) {
            $query->fields[] = Filter::field($field);
        }

        return $query;
    }

    /**
     * Sort by a field, after any sort already given.
     */
    public function orderBy(string $field, string $direction = 'asc'): self
    {
        $direction = strtolower($direction);

        if (! in_array($direction, ['asc', 'desc'], true)) {
            throw new InvalidArgumentException('Sort direction must be "asc" or "desc", not "'.$direction.'".');
        }

        $query = clone $this;
        $query->sort[] = Filter::field($field).':'.$direction;

        return $query;
    }

    /**
     * How many records to skip, counting from 0.
     */
    public function offset(?int $offset): self
    {
        if ($offset !== null && $offset < 0) {
            throw new InvalidArgumentException('The offset cannot be negative.');
        }

        $query = clone $this;
        $query->offset = $offset;

        return $query;
    }

    /**
     * How many records to return.
     */
    public function limit(?int $limit): self
    {
        if ($limit !== null && $limit < 1) {
            throw new InvalidArgumentException('The limit must be at least 1.');
        }

        $query = clone $this;
        $query->limit = $limit;

        return $query;
    }

    /**
     * Another query parameter the endpoint documents, such as dateFormat or archived.
     */
    public function with(string $parameter, mixed $value): self
    {
        $query = clone $this;
        $query->parameters[$parameter] = $value;

        return $query;
    }

    /**
     * The query without its offset and limit, for a paginator to page itself.
     */
    public function withoutPaging(): self
    {
        return $this->offset(null)->limit(null);
    }

    /**
     * @return list<string>
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return list<string>
     */
    public function getSort(): array
    {
        return $this->sort;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * The query parameters, under the names an endpoint takes them by; what it has no name for is left out.
     *
     * @return array<string, mixed>
     */
    public function toArray(?string $filter = 'query', ?string $fields = 'fields', ?string $sort = 'sort', ?string $offset = 'pageStart', ?string $size = 'pageSize'): array
    {
        $query = $this->parameters;

        if ($filter !== null && ! $this->filter->isEmpty()) {
            $query[$filter] = $this->filter->toString();
        }

        if ($fields !== null && $this->fields !== []) {
            $query[$fields] = implode(',', $this->fields);
        }

        if ($sort !== null && $this->sort !== []) {
            $query[$sort] = implode(',', $this->sort);
        }

        if ($offset !== null && $this->offset !== null) {
            $query[$offset] = $this->offset;
        }

        if ($size !== null && $this->limit !== null) {
            $query[$size] = $this->limit;
        }

        return $query;
    }

    /**
     * The query string as you would read it, unencoded, for logs and debugging.
     */
    public function __toString(): string
    {
        return urldecode(QueryString::encode($this->toArray()));
    }
}
