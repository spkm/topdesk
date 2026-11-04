<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Download an attachment: GET /tas/api/incidents/id/{incidentId}/attachments/{attachmentId}/download.
 */
class DownloadIncidentAttachmentRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'application/octet-stream';

    protected bool $cacheable = false;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $incidentId, protected int|string $attachmentId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/id/'.Path::segment((string) $this->incidentId).'/attachments/'.Path::segment((string) $this->attachmentId).'/download';
    }
}
