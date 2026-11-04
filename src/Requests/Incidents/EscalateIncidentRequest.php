<?php

namespace spkm\Topdesk\Requests\Incidents;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Incidents\Incident;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Escalate an incident by id: PUT /tas/api/incidents/id/{id}/escalate.
 *
 * NOTE: PATCH operation can be used as well. Duration and operator of linked SLA are not considered when escalating
 * the incident.
 */
class EscalateIncidentRequest extends WriteRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = Incident::class;

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
        return '/tas/api/incidents/id/'.Path::segment((string) $this->id).'/escalate';
    }
}
