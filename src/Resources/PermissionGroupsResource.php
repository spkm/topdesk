<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\SupportingFiles\SearchlistDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\PermissionGroups\GetPermissionGroupsRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The permission groups endpoints of TOPdesk's Supporting Files API, from Topdesk::permissionGroups().
 *
 * @extends Builder<SearchlistDto>
 */
class PermissionGroupsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SearchlistDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetPermissionGroupsRequest($query);
    }

    /**
     * Get list of permission groups: GET /tas/api/permissiongroups.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getPermissionGroups(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetPermissionGroupsRequest($query));
    }
}
