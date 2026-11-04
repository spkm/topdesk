<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\SupportingFiles\RequesterLocationDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\RequesterLocations\GetRequesterLocationsRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The requester locations endpoints of TOPdesk's Supporting Files API, from Topdesk::requesterLocations().
 *
 * @extends Builder<RequesterLocationDto>
 */
class RequesterLocationsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, RequesterLocationDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetRequesterLocationsRequest($query);
    }

    /**
     * Get list of locations for SSP user: GET /tas/api/requester/locations.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequesterLocationDto>
     */
    public function getRequesterLocations(): PagedResource
    {
        return new PagedResource($this->connector, RequesterLocationDto::class, fn (Query $query) => new GetRequesterLocationsRequest($query));
    }
}
