<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\General\IdAndName;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ArchivingReasons\GetArchivingReasonsRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The archiving reasons endpoints of TOPdesk's General API, from Topdesk::archivingReasons().
 *
 * @extends Builder<IdAndName>
 */
class ArchivingReasonsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, IdAndName::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetArchivingReasonsRequest($query);
    }

    /**
     * Get list of reasons for archiving: GET /tas/api/archiving-reasons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<IdAndName>
     */
    public function getArchivingReasons(): PagedResource
    {
        return new PagedResource($this->connector, IdAndName::class, fn (Query $query) => new GetArchivingReasonsRequest($query));
    }
}
