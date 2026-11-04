<?php

namespace spkm\Topdesk\Requests\ReservationCancellationReasons;

use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchives a cancellation reason: POST /tas/api/reservationCancellationReasons/{identifier}/unarchive.
 *
 * Unarchives a cancellation reason for planned reservations
 */
class UnarchiveReservationCancellationReasonRequest extends ActionRequest
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
        return '/tas/api/reservationCancellationReasons/'.Path::segment((string) $this->identifier).'/unarchive';
    }
}
