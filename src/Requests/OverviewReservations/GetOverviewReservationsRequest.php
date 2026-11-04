<?php

namespace spkm\Topdesk\Requests\OverviewReservations;

use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of reservations: GET /tas/api/overviewReservations.
 *
 * Deprecated, use /reservations instead. Returns a list of reservations
 *
 * @deprecated TOPdesk deprecated this endpoint.
 */
class GetOverviewReservationsRequest extends ListRequest
{
    protected ?string $dto = ReservationDto::class;

    protected ?string $fieldsParameter = '$fields';

    protected ?string $sizeParameter = '$top';

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: plannedFrom, plannedTo, locationId, objectId, archived.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/overviewReservations';
    }
}
