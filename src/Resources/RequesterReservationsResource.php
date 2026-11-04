<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\RequesterReservations\CreateRequesterReservationRequest;

/**
 * The requester reservations endpoints of TOPdesk's Reservations API, from Topdesk::requesterReservations().
 *
 * @extends BaseResource<Data>
 */
class RequesterReservationsResource extends BaseResource
{
    /**
     * Creates a single reservation for a SSP user: POST /tas/api/requester/reservations.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createRequesterReservation(array|JsonSerializable $body, array $options = []): ?ReservationDto
    {
        return $this->fetch(new CreateRequesterReservationRequest($body, $options));
    }
}
