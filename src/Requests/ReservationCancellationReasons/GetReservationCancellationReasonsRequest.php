<?php

namespace spkm\Topdesk\Requests\ReservationCancellationReasons;

use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns cancellation reasons: GET /tas/api/reservationCancellationReasons.
 *
 * Returns the list of possible cancellation reasons for planned reservations
 */
class GetReservationCancellationReasonsRequest extends ListRequest
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
        return '/tas/api/reservationCancellationReasons';
    }
}
