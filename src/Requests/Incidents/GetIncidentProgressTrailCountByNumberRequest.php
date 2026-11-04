<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get incident progress trail entry count by incident number: GET
 * /tas/api/incidents/number/{number}/progresstrail/count.
 */
class GetIncidentProgressTrailCountByNumberRequest extends GetRequest
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
        return '/tas/api/incidents/number/'.Path::segment((string) $this->number).'/progresstrail/count';
    }
}
