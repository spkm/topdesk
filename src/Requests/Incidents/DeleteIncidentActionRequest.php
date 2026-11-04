<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete action by incident id and action id: DELETE /tas/api/incidents/id/{incidentid}/actions/{actionid}.
 */
class DeleteIncidentActionRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $incidentid, protected int|string $actionid, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/id/'.Path::segment((string) $this->incidentid).'/actions/'.Path::segment((string) $this->actionid);
    }
}
