<?php

namespace spkm\Topdesk\Requests\ReservableLocations;

use spkm\Topdesk\Data\Reservations\ReservableLocationIntervalDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns a reservable interval for a reservable location: GET /tas/api/reservableLocations/{id}/reservableInterval.
 *
 * Returns a reservable interval for a reservable location, based on its UUID and the provided start of the interval
 * (from).
 */
class GetReservableLocationReservableIntervalRequest extends GetRequest
{
    protected ?string $dto = ReservableLocationIntervalDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: from.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservableLocations/'.Path::segment((string) $this->id).'/reservableInterval';
    }
}
