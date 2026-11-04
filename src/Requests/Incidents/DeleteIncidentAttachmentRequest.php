<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete a file from an incident identified by id: DELETE
 * /tas/api/incidents/id/{incidentId}/attachments/{attachmentId}.
 */
class DeleteIncidentAttachmentRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $incidentId, protected int|string $attachmentId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/id/'.Path::segment((string) $this->incidentId).'/attachments/'.Path::segment((string) $this->attachmentId);
    }
}
