<?php

namespace spkm\Topdesk\Requests\Reservations;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Reschedules a reservation: POST /tas/api/reservations/{identifier}/reschedule.
 *
 * Reschedules a reservation. Only planned or requested reservations can be rescheduled. It is an error to try to
 * reschedule an archived, cancelled, or rejected reservation. It is also not possible to reschedule a reservation that
 * has one or more issued facilities.
 */
class RescheduleReservationRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowServicesOutsideReservation, allowReservationOutsideEvent, allowPassedLeadTimes, allowServicesOutsideServiceWindow, rescheduleVisitors.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations/'.Path::segment((string) $this->identifier).'/reschedule';
    }
}
