<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\Categories\GetCategoriesRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The categories endpoints of TOPdesk's General API, from Topdesk::categories().
 *
 * @extends Builder<Data>
 */
class CategoriesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, null);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetCategoriesRequest($query);
    }

    /**
     * Lists categories and subcategories: GET /tas/api/categories.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Data>
     */
    public function getCategories(): PagedResource
    {
        return new PagedResource($this->connector, null, fn (Query $query) => new GetCategoriesRequest($query));
    }
}
