<?php

namespace spkm\Topdesk\Requests\ReservableLocations;

use spkm\Topdesk\Data\Reservations\Location;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of reservable locations: GET /tas/api/reservableLocations.
 *
 * Returns a list of reservable, non-archived locations
 */
class GetReservableLocationsRequest extends ListRequest
{
    protected ?string $dto = Location::class;

    protected ?string $fieldsParameter = '$fields';

    protected ?string $sizeParameter = '$top';

    protected ?int $maxPageSize = 10000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: branchId.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservableLocations';
    }
}
