<?php

namespace spkm\Topdesk\Requests\ReservableServices;

use spkm\Topdesk\Data\Reservations\ReservableServiceDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns a reservable service: GET /tas/api/reservableServices/{id}.
 */
class GetReservableServiceRequest extends GetRequest
{
    protected ?string $dto = ReservableServiceDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: $fields.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservableServices/'.Path::segment((string) $this->id);
    }
}
