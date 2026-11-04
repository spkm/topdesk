<?php

namespace spkm\Topdesk\Requests\ReservationRejectionReasons;

use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archives a rejection reason: POST /tas/api/reservationRejectionReasons/{identifier}/archive.
 *
 * Archives a rejection reason for reservation requests
 */
class ArchiveReservationRejectionReasonRequest extends ActionRequest
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
        return '/tas/api/reservationRejectionReasons/'.Path::segment((string) $this->identifier).'/archive';
    }
}
