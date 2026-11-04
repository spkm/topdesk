<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Downloads the file attachment of the operational activity: GET
 * /tas/api/operationalActivities/{identifier}/attachments/{attachmentId}/download.
 *
 * Suitable for retrieving files, but not for links. See the type attribute of #/components/schemas/attachment.
 */
class DownloadOperationalActivityAttachmentRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'application/octet-stream';

    protected bool $cacheable = false;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $attachmentId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalActivities/'.Path::segment((string) $this->identifier).'/attachments/'.Path::segment((string) $this->attachmentId).'/download';
    }
}
