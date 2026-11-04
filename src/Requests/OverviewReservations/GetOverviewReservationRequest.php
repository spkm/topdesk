<?php

namespace spkm\Topdesk\Requests\OverviewReservations;

use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns a reservation by id: GET /tas/api/overviewReservations/{id}.
 *
 * Deprecated, use /reservations/{id} instead. Returns a reservation, based on its UUID
 *
 * @deprecated TOPdesk deprecated this endpoint.
 */
class GetOverviewReservationRequest extends GetRequest
{
    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: $fields.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/overviewReservations/'.Path::segment((string) $this->id);
    }
}
