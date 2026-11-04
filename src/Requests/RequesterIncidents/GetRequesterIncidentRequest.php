<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Data\Incidents\RequesterIncident;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns an incident for a SSP user: GET /tas/api/requester/incidents/id/{id}.
 */
class GetRequesterIncidentRequest extends GetRequest
{
    protected ?string $dto = RequesterIncident::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents/id/'.Path::segment((string) $this->id);
    }
}
