<?php

namespace spkm\Topdesk\Requests\ReservationRejectionReasons;

use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns rejection reasons: GET /tas/api/reservationRejectionReasons.
 *
 * Returns the list of possible rejection reasons for reservation requests
 */
class GetReservationRejectionReasonsRequest extends ListRequest
{
    protected ?string $dto = SearchlistDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: archived.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservationRejectionReasons';
    }
}
