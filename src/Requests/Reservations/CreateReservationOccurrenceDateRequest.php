<?php

namespace spkm\Topdesk\Requests\Reservations;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Add occurrences to a reservation that is recurrent on specific dates: POST
 * /tas/api/reservations/{identifier}/occurrences/dates.
 *
 * Add occurrences to a reservation series using the 'specific dates' pattern. Reservations with services on facilities
 * can be added to this way, but those with separately reserved services cannot. Neither can reservations with issued
 * facilities.
 */
class CreateReservationOccurrenceDateRequest extends WriteRequest
{
    protected string $responseShape = self::LIST;

    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowConflicts.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations/'.Path::segment((string) $this->identifier).'/occurrences/dates';
    }
}
