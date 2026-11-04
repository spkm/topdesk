<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete request by incident number and request id: DELETE
 * /tas/api/incidents/number/{incidentnumber}/requests/{requestid}.
 */
class DeleteIncidentRequestEntryByNumberRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $incidentnumber, protected int|string $requestid, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/number/'.Path::segment((string) $this->incidentnumber).'/requests/'.Path::segment((string) $this->requestid);
    }
}
