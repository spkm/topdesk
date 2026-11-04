<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete a file from an incident identified by number: DELETE
 * /tas/api/incidents/number/{incidentNumber}/attachments/{attachmentId}.
 */
class DeleteIncidentAttachmentByNumberRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $incidentNumber, protected int|string $attachmentId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/number/'.Path::segment((string) $this->incidentNumber).'/attachments/'.Path::segment((string) $this->attachmentId);
    }
}
