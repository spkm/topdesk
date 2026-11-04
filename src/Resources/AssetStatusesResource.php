<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Assets\AssetStatus;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\AssetStatuses\GetAssetStatusesRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The asset statuses endpoints of TOPdesk's Asset Management API, from Topdesk::assetStatuses().
 *
 * @extends Builder<AssetStatus>
 */
class AssetStatusesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, AssetStatus::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetAssetStatusesRequest($query);
    }

    /**
     * Returns a list of all asset statuses: GET /tas/api/assetmgmt/assetStatuses.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<AssetStatus>
     */
    public function getAssetStatuses(): PagedResource
    {
        return new PagedResource($this->connector, AssetStatus::class, fn (Query $query) => new GetAssetStatusesRequest($query));
    }
}
