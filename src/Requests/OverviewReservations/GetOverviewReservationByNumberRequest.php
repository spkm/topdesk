<?php

namespace spkm\Topdesk\Requests\OverviewReservations;

use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns a reservation by number: GET /tas/api/overviewReservations/number/{number}.
 *
 * Deprecated, use /reservations/number/{number} instead. Returns a reservation, based on its number
 *
 * @deprecated TOPdesk deprecated this endpoint.
 */
class GetOverviewReservationByNumberRequest extends GetRequest
{
    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: $fields.
     */
    public function __construct(protected int|string $number, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/overviewReservations/number/'.Path::segment((string) $this->number);
    }
}
