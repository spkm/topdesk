<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Assets\DataSetItem;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\AssetTemplates\GetTemplatesRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The asset templates endpoints of TOPdesk's Asset Management API, from Topdesk::assetTemplates().
 *
 * @extends Builder<DataSetItem>
 */
class AssetTemplatesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, DataSetItem::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetTemplatesRequest($query);
    }

    /**
     * Returns all templates: GET /tas/api/assetmgmt/templates.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<DataSetItem>
     */
    public function getTemplates(): PagedResource
    {
        return new PagedResource($this->connector, DataSetItem::class, fn (Query $query) => new GetTemplatesRequest($query));
    }
}
