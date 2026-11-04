<?php

namespace spkm\Topdesk\Requests\Branches;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Download an attachment: GET /tas/api/branches/id/{id}/attachments/{attachmentId}/download.
 */
class DownloadBranchAttachmentRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'application/octet-stream';

    protected bool $cacheable = false;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, protected int|string $attachmentId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/branches/id/'.Path::segment((string) $this->id).'/attachments/'.Path::segment((string) $this->attachmentId).'/download';
    }
}
