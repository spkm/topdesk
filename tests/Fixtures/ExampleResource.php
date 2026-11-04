<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * @extends Builder<ExampleData>
 */
class ExampleResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ExampleData::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new ExampleListRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new ExampleItemRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new ExampleCreateRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new ExampleUpdateRequest($id, $body);
    }

    protected function deleteRequest(int|string $id): TopdeskRequest
    {
        return new ExampleDeleteRequest($id);
    }
}
