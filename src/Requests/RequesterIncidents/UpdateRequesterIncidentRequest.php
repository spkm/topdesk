<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Incidents\RequesterIncident;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates an Incident for a SSP user: PATCH /tas/api/requester/incidents/id/{id}.
 *
 * closed feedbackRating feedbackMessage
 */
class UpdateRequesterIncidentRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = RequesterIncident::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents/id/'.Path::segment((string) $this->id);
    }
}
