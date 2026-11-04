<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\General\IdAndName;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TimeSpentReasons\GetTimeSpentReasonsRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The time spent reasons endpoints of TOPdesk's General API, from Topdesk::timeSpentReasons().
 *
 * @extends Builder<IdAndName>
 */
class TimeSpentReasonsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, IdAndName::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetTimeSpentReasonsRequest($query);
    }

    /**
     * Get list of reasons for time spent: GET /tas/api/timespent-reasons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<IdAndName>
     */
    public function getTimeSpentReasons(): PagedResource
    {
        return new PagedResource($this->connector, IdAndName::class, fn (Query $query) => new GetTimeSpentReasonsRequest($query));
    }
}
