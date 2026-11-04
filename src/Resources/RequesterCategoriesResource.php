<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\RequesterCategories\GetRequesterCategoriesRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The requester categories endpoints of TOPdesk's General API, from Topdesk::requesterCategories().
 *
 * @extends Builder<Data>
 */
class RequesterCategoriesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, null);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetRequesterCategoriesRequest($query);
    }

    /**
     * Lists categories and subcategories for SSP user: GET /tas/api/requester/categories.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Data>
     */
    public function getRequesterCategories(): PagedResource
    {
        return new PagedResource($this->connector, null, fn (Query $query) => new GetRequesterCategoriesRequest($query));
    }
}
