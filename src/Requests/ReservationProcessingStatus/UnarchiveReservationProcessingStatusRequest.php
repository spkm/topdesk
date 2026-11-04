<?php

namespace spkm\Topdesk\Requests\ReservationProcessingStatus;

use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchives a reservation processing status: POST /tas/api/reservationProcessingStatus/{identifier}/unarchive.
 *
 * Unarchives a processing status option for reservations and requests
 */
class UnarchiveReservationProcessingStatusRequest extends ActionRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = SearchlistDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservationProcessingStatus/'.Path::segment((string) $this->identifier).'/unarchive';
    }
}
