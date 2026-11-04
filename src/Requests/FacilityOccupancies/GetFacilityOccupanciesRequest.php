<?php

namespace spkm\Topdesk\Requests\FacilityOccupancies;

use spkm\Topdesk\Data\Reservations\OccupiedFacility;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns the occupancy rates for the given facilities: GET /tas/api/facilityOccupancies.
 *
 * Returns the occupancy rates of the selected facilities in the selected range of days, averaged for each one-hour
 * interval. Select facilities by providing at least one locationId or objectId. Omitting both parameters will yield an
 * empty result.
 */
class GetFacilityOccupanciesRequest extends ListRequest
{
    protected ?string $dto = OccupiedFacility::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: locationId, objectId, periodStartDate, periodEndDate, timeStart, timeEnd, timeZone, weekDay.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/facilityOccupancies';
    }
}
