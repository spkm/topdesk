<?php

namespace spkm\Topdesk\Requests;

use Saloon\Enums\Method;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use spkm\Topdesk\Query\Query;

/**
 * A GET for a collection's records, filtered, sorted and paged by a Query. TOPdesk's endpoints name their
 * parameters differently (query or none for the FIQL filter; fields or $fields; pageStart and pageSize, start and
 * page_size, or $top alone), so each list request says which it takes, and the Query is written out under those
 * names. TOPdesk answers 206 Partial Content while more records follow, 200 OK with the last of them, and 204 No
 * Content when there are none; TopdeskPaginator pages through them all.
 */
abstract class ListRequest extends TopdeskRequest implements Paginatable
{
    protected Method $method = Method::GET;

    protected string $responseShape = self::LIST;

    protected bool $cacheable = true;

    /**
     * The parameter the endpoint takes a FIQL filter in, or null when it takes none.
     */
    protected ?string $filterParameter = null;

    /**
     * The parameter the endpoint takes the fields to return in, or null when it takes none.
     */
    protected ?string $fieldsParameter = null;

    /**
     * The parameter the endpoint takes a sort in (field:asc,other:desc), or null when it takes none.
     */
    protected ?string $sortParameter = null;

    /**
     * The parameter the endpoint takes the first record's offset in, or null when it can't be paged.
     */
    protected ?string $offsetParameter = null;

    /**
     * The parameter the endpoint takes how many records to return in, or null when it takes none.
     */
    protected ?string $sizeParameter = null;

    /**
     * The most records the endpoint returns at once, or null when it documents no limit (a list that takes no
     * offset then answers every record unless told how many).
     */
    protected ?int $maxPageSize = 1000;

    /** @var Query|array<string, mixed> */
    protected Query|array $parameters;

    /**
     * @param  Query|array<string, mixed>  $query
     */
    public function __construct(Query|array $query = [])
    {
        $this->parameters = $query;
    }

    public function filterParameter(): ?string
    {
        return $this->filterParameter;
    }

    public function fieldsParameter(): ?string
    {
        return $this->fieldsParameter;
    }

    public function sortParameter(): ?string
    {
        return $this->sortParameter;
    }

    public function offsetParameter(): ?string
    {
        return $this->offsetParameter;
    }

    public function sizeParameter(): ?string
    {
        return $this->sizeParameter;
    }

    public function maxPageSize(): ?int
    {
        return $this->maxPageSize;
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        if (! $this->parameters instanceof Query) {
            return $this->parameters;
        }

        $query = $this->parameters;

        if ($this->maxPageSize !== null && $query->getLimit() !== null && $query->getLimit() > $this->maxPageSize) {
            $query = $query->limit($this->maxPageSize);
        }

        return $query->toArray($this->filterParameter, $this->fieldsParameter, $this->sortParameter, $this->offsetParameter, $this->sizeParameter);
    }
}
