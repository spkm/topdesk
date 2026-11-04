<?php

namespace spkm\Topdesk\Requests\Reservations;

use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns a reservation: GET /tas/api/reservations/{identifier}.
 */
class GetReservationRequest extends GetRequest
{
    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: $fields.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations/'.Path::segment((string) $this->identifier);
    }
}
