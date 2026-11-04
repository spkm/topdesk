<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete action by incident number and action id: DELETE
 * /tas/api/incidents/number/{incidentnumber}/actions/{actionid}.
 */
class DeleteIncidentActionByNumberRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $incidentnumber, protected int|string $actionid, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/number/'.Path::segment((string) $this->incidentnumber).'/actions/'.Path::segment((string) $this->actionid);
    }
}
