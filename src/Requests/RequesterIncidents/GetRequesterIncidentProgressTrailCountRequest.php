<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident progress trail entry count by incident id for SSP users: GET
 * /tas/api/requester/incidents/id/{id}/progresstrail/count.
 */
class GetRequesterIncidentProgressTrailCountRequest extends GetRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents/id/'.Path::segment((string) $this->id).'/progresstrail/count';
    }
}
