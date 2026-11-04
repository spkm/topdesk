<?php

namespace spkm\Topdesk\Requests\Reservations;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates a reservation: PATCH /tas/api/reservations/{identifier}.
 *
 * To update status, plannedStart/EndDate, and reservedFacilities, use their respective dedicated endpoints.
 */
class UpdateReservationRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: occurrences, allowPassedLeadTimes.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations/'.Path::segment((string) $this->identifier);
    }
}
