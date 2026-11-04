<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident progress trail entry count by incident id: GET /tas/api/incidents/id/{id}/progresstrail/count.
 */
class GetIncidentProgressTrailCountRequest extends GetRequest
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
        return '/tas/api/incidents/id/'.Path::segment((string) $this->id).'/progresstrail/count';
    }
}
