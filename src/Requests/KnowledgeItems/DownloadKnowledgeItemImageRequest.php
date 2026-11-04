<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Downloads an image from the Knowledge Item: GET
 * /services/knowledge-base-v1/knowledgeItems/{identifier}/images/{imageName}/download.
 *
 * Downloads an image with a given name from the Knowledge item with the given identifier. It is necessary to have the
 * permission to read Knowledge Items. If additionally the permission to update Knowledge Items is present, then branch
 * filters will not apply.
 */
class DownloadKnowledgeItemImageRequest extends GetRequest
{
    protected string $responseShape = self::TEXT;

    protected ?string $accept = 'image/*';

    protected bool $cacheable = false;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $imageName, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/images/'.Path::segment((string) $this->imageName).'/download';
    }
}
