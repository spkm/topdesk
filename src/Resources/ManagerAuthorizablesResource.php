<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Changes\ManagerAuthorizableEntry;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\ManagerAuthorizables\GetManagerAuthorizablesRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The manager authorizables endpoints of TOPdesk's Change Management API, from Topdesk::managerAuthorizables().
 *
 * @extends Builder<ManagerAuthorizableEntry>
 */
class ManagerAuthorizablesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ManagerAuthorizableEntry::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetManagerAuthorizablesRequest($query);
    }

    /**
     * Returns a list of changes or authorization activities for which the currently logged in user is the manager: GET
     * /tas/api/managerAuthorizables.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ManagerAuthorizableEntry>
     */
    public function getManagerAuthorizables(): PagedResource
    {
        return new PagedResource($this->connector, ManagerAuthorizableEntry::class, fn (Query $query) => new GetManagerAuthorizablesRequest($query));
    }
}
