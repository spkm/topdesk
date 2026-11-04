<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete request by incident id and request id: DELETE /tas/api/incidents/id/{incidentid}/requests/{requestid}.
 */
class DeleteIncidentRequestEntryRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $incidentid, protected int|string $requestid, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/id/'.Path::segment((string) $this->incidentid).'/requests/'.Path::segment((string) $this->requestid);
    }
}
