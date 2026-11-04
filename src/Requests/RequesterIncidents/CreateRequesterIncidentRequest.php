<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use JsonSerializable;
use spkm\Topdesk\Data\Incidents\RequesterIncident;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Creates an Incident for a SSP user: POST /tas/api/requester/incidents.
 *
 * briefDescription callType category subcategory object location operatorGroup
 */
class CreateRequesterIncidentRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = RequesterIncident::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents';
    }
}
