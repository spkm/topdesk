<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\Search\GetSearchRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The search endpoints of TOPdesk's General API, from Topdesk::search().
 *
 * @extends Builder<Data>
 */
class SearchResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, null);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetSearchRequest($query);
    }

    /**
     * Search via the REST-API: GET /tas/api/search.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Data>
     */
    public function getSearch(): PagedResource
    {
        return new PagedResource($this->connector, null, fn (Query $query) => new GetSearchRequest($query));
    }
}
