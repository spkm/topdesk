<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident progress trail entry count by incident number for SSP users: GET
 * /tas/api/requester/incidents/number/{number}/progresstrail/count.
 */
class GetRequesterIncidentProgressTrailCountByNumberRequest extends GetRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $number, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents/number/'.Path::segment((string) $this->number).'/progresstrail/count';
    }
}
