<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Reservations\OccupiedFacility;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\FacilityOccupancies\GetFacilityOccupanciesRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The facility occupancies endpoints of TOPdesk's Reservations API, from Topdesk::facilityOccupancies().
 *
 * @extends Builder<OccupiedFacility>
 */
class FacilityOccupanciesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, OccupiedFacility::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetFacilityOccupanciesRequest($query);
    }

    /**
     * Returns the occupancy rates for the given facilities: GET /tas/api/facilityOccupancies.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<OccupiedFacility>
     */
    public function getFacilityOccupancies(): PagedResource
    {
        return new PagedResource($this->connector, OccupiedFacility::class, fn (Query $query) => new GetFacilityOccupanciesRequest($query));
    }
}
