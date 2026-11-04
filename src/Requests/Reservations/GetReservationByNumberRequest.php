<?php

namespace spkm\Topdesk\Requests\Reservations;

use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * This endpoint has been deprecated, since it is now possible to use the reservation number instead of id in all
 * endpoint URLs: GET /tas/api/reservations/number/{number}.
 *
 * @deprecated TOPdesk deprecated this endpoint.
 */
class GetReservationByNumberRequest extends GetRequest
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
        return '/tas/api/reservations/number/'.Path::segment((string) $this->number);
    }
}
