<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * A collection TOPdesk only lists, without filtering, sorting or choosing fields.
 *
 * @extends Builder<ExampleData>
 */
class ExampleReadOnlyResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ExampleData::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new ExampleUnfilteredListRequest($query);
    }
}
