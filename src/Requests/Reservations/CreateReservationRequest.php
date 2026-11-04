<?php

namespace spkm\Topdesk\Requests\Reservations;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Creates a single reservation: POST /tas/api/reservations.
 *
 * Setting the requester will also set all related fields from the given person.
 */
class CreateReservationRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowPassedLeadTimes, allowServicesOutsideServiceWindow, rescheduleVisitors.
     */
    public function __construct(array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations';
    }
}
