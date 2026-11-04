<?php

namespace spkm\Topdesk\Requests\ReservableLocations;

use spkm\Topdesk\Data\Reservations\Location;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns a reservable location by id: GET /tas/api/reservableLocations/{id}.
 */
class GetReservableLocationRequest extends GetRequest
{
    protected ?string $dto = Location::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: $fields.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservableLocations/'.Path::segment((string) $this->id);
    }
}
