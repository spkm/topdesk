<?php

namespace spkm\Topdesk\Requests\Reservations;

use JsonSerializable;
use spkm\Topdesk\Data\Reservations\ReservationDto;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Rejects a reservation request: POST /tas/api/reservations/{identifier}/reject.
 *
 * Reject a reservation. A reservation is only allowed to be rejected if it is not archived, its status is 'request' or
 * 'conflictingRequest', it doesn't have services and it is not part of a recurrent series. The body of the request is
 * optional if TOPdesk is configured with a default rejection reason.
 */
class RejectReservationRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = ReservationDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations/'.Path::segment((string) $this->identifier).'/reject';
    }
}
