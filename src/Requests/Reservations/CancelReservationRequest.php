<?php

namespace spkm\Topdesk\Requests\Reservations;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Cancels a reservation: POST /tas/api/reservations/{identifier}/cancel.
 *
 * Cancel a reservation. A reservation is only allowed to be cancelled if it is not archived, its status is 'planned'
 * or 'conflictingPlanned', and it does not have any facilities which have already been issued. The body of the request
 * is optional if TOPdesk is configured with a default cancellation reason.
 */
class CancelReservationRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: allowPassedLeadTimes.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservations/'.Path::segment((string) $this->identifier).'/cancel';
    }
}
