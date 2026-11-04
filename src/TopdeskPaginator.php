<?php

namespace spkm\Topdesk;

use Illuminate\Support\LazyCollection;
use JsonException;
use LogicException;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Paginator;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Exceptions\ServerErrorException;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\Support\Payload;

/**
 * Pages through a TOPdesk list by the offset and size parameters its request names (pageStart and pageSize, start
 * and page_size, or offset and pageSize), from an offset of 0. TOPdesk answers 206 Partial Content while more
 * records follow, 200 OK with the last of them, and 204 No Content when there are none; some lists link to their
 * next page or give a total instead. A list that takes no offset is fetched in one request, for as many records as
 * the endpoint allows, or without a size when it documents no limit.
 */
class TopdeskPaginator extends Paginator
{
    protected ?int $perPageLimit = 100;

    protected ?string $lastPageFingerprint = null;

    protected ?Response $lastResponse = null;

    /** @var list<array<string, mixed>> */
    protected array $lastItems = [];

    public function __construct(Connector $connector, Request $request, ?int $perPage = null)
    {
        parent::__construct($connector, $request);

        if ($perPage !== null) {
            $this->perPageLimit = max(1, min($perPage, $this->maxPageSize() ?? $perPage));
        }

        if ($this->offsetParameter() === null) {
            $this->perPageLimit = $this->maxPageSize();
        }
    }

    /**
     * Every item on every page, as the request's models.
     *
     * @return LazyCollection<int, Data>
     */
    public function dtos(): LazyCollection
    {
        $request = $this->getOriginalRequest();
        $dto = $request instanceof TopdeskRequest ? $request->dtoClass() : null;

        if ($dto === null) {
            throw new LogicException(class_basename($request).' has no model; use collect() for its items as arrays.');
        }

        return $this->models($dto);
    }

    /**
     * Every item on every page as the given model.
     *
     * @template TModel of Data
     *
     * @param  class-string<TModel>  $model
     * @return LazyCollection<int, TModel>
     */
    public function models(string $model): LazyCollection
    {
        return $this->collect()->map(fn (array $item) => $model::from($item));
    }

    protected function applyPagination(Request $request): Request
    {
        $offset = $this->offsetParameter();
        $size = $request instanceof ListRequest ? $request->sizeParameter() : 'pageSize';

        if ($offset !== null) {
            $request->query()->add($offset, ($this->page - 1) * (int) $this->perPageLimit);
        }

        if ($size !== null && $this->perPageLimit !== null) {
            $request->query()->add($size, $this->perPageLimit);
        }

        return $request;
    }

    protected function isLastPage(Response $response): bool
    {
        if ($this->getPageItems($response, $response->getRequest()) === [] || $this->offsetParameter() === null) {
            return true;
        }

        try {
            $total = Payload::total($response);
        } catch (JsonException) {
            return true;
        }

        if ($total !== null) {
            return $this->totalResults >= $total;
        }

        return $response->status() !== 206 && ! Payload::hasNext($response);
    }

    protected function onRewind(): void
    {
        $this->lastPageFingerprint = null;
        $this->lastResponse = null;
        $this->lastItems = [];
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function getPageItems(Response $response, Request $request): array
    {
        if (! $response->successful()) {
            throw TopdeskApiException::fromResponse($response);
        }

        if ($response === $this->lastResponse) {
            return $this->lastItems;
        }

        try {
            $items = Payload::records($response);
        } catch (JsonException) {
            throw new ServerErrorException($response);
        }

        // An endpoint that ignores the offset would answer the same page forever: a repeated page is the end.
        $fingerprint = sha1((string) json_encode($items));
        $this->lastResponse = $response;
        $this->lastItems = $fingerprint === $this->lastPageFingerprint ? [] : $items;
        $this->lastPageFingerprint = $fingerprint;

        return $this->lastItems;
    }

    private function offsetParameter(): ?string
    {
        $request = $this->getOriginalRequest();

        return $request instanceof ListRequest ? $request->offsetParameter() : 'pageStart';
    }

    private function maxPageSize(): ?int
    {
        $request = $this->getOriginalRequest();

        return $request instanceof ListRequest ? $request->maxPageSize() : 1000;
    }
}
