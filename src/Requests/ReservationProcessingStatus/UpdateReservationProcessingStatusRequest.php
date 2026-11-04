<?php

namespace spkm\Topdesk\Requests\ReservationProcessingStatus;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Reservations\SearchlistDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates a reservation processing status: PATCH /tas/api/reservationProcessingStatus/{identifier}.
 *
 * Updates the name of a processing status option for reservations and requests
 */
class UpdateReservationProcessingStatusRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = SearchlistDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservationProcessingStatus/'.Path::segment((string) $this->identifier);
    }
}
