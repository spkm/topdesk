<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Downloads an attachment from a Knowledge Item: GET
 * /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments/{attachmentIdentifier}/download.
 *
 * Downloads an attachment with a given attachment identifier from a Knowledge Item with the given identifier. It is
 * necessary to have the permission to read Knowledge Items. If additionally the permission to update Knowledge Items
 * is present, then branch filters will not apply.
 */
class DownloadKnowledgeItemAttachmentRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'application/octet-stream';

    protected bool $cacheable = false;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $attachmentIdentifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/attachments/'.Path::segment((string) $this->attachmentIdentifier).'/download';
    }
}
