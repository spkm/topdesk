<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Download an attachment for a SSP user: GET
 * /tas/api/requester/incidents/id/{incidentId}/attachments/{attachmentId}/download.
 */
class DownloadRequesterIncidentAttachmentRequest extends GetRequest
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
        return '/tas/api/requester/incidents/id/'.Path::segment((string) $this->incidentId).'/attachments/'.Path::segment((string) $this->attachmentId).'/download';
    }
}
