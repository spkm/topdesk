<?php

namespace spkm\Topdesk\Requests\Reservations;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Adds and removes services for a reserved facility: POST /tas/api/reservations/{identifier}/reservedServices.
 *
 * The added services will be reserved with the default values from the service card. For removing services, use the id
 * of the reserved service (from reservation.reservedFacilities.reservedServices.id), not the id of the original
 * service.
 */
class CreateReservationReservedServiceRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowPassedLeadTimes, allowServicesOutsideServiceWindow.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations/'.Path::segment((string) $this->identifier).'/reservedServices';
    }
}
