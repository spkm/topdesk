<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\SupportingFiles\RequesterBranchDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\RequesterBranches\GetRequesterBranchesRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The requester branches endpoints of TOPdesk's Supporting Files API, from Topdesk::requesterBranches().
 *
 * @extends Builder<RequesterBranchDto>
 */
class RequesterBranchesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, RequesterBranchDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetRequesterBranchesRequest($query);
    }

    /**
     * Get list of branches for SSP user: GET /tas/api/requester/branches.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequesterBranchDto>
     */
    public function getRequesterBranches(): PagedResource
    {
        return new PagedResource($this->connector, RequesterBranchDto::class, fn (Query $query) => new GetRequesterBranchesRequest($query));
    }
}
