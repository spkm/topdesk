<?php

namespace spkm\Topdesk\Requests\Reservations;

use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Approves a reservation request: POST /tas/api/reservations/{identifier}/approve.
 *
 * Approve a reservation. A reservation is only allowed to be approved if it is not archived, its status is 'request',
 * it doesn't have services and it is not part of a recurrent series.
 */
class ApproveReservationRequest extends ActionRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations/'.Path::segment((string) $this->identifier).'/approve';
    }
}
