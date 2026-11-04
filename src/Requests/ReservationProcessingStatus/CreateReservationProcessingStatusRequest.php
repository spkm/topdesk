<?php

namespace spkm\Topdesk\Requests\ReservationProcessingStatus;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Creates a reservation processing status: POST /tas/api/reservationProcessingStatus.
 *
 * Creates a processing status option for reservations and requests
 */
class CreateReservationProcessingStatusRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = SearchlistDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservationProcessingStatus';
    }
}
