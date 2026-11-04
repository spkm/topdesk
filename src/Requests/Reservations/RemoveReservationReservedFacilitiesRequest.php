<?php

namespace spkm\Topdesk\Requests\Reservations;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Remove reserved facilities: POST /tas/api/reservations/{identifier}/reservedFacilities/remove.
 *
 * Remove reserved facilities from a reservation. Only planned or requested reservations and conflicts can have their
 * facilities changed: it is an error to try to reschedule an archived, cancelled or rejected reservation. It is also
 * not possible to reschedule a reservation that has one or more issued facilities, or an occurrence of a recurring
 * reservation series.
 */
class RemoveReservationReservedFacilitiesRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowPassedLeadTimes.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations/'.Path::segment((string) $this->identifier).'/reservedFacilities/remove';
    }
}
