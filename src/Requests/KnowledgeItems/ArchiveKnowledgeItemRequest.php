<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archives the Knowledge Item: POST /services/knowledge-base-v1/knowledgeItems/{identifier}/archive.
 *
 * Archives the Knowledge Item with the given identifier. If the Knowledge Item is already archived nothing will
 * change. It is necessary to have the permission to update and archive Knowledge Items.
 */
class ArchiveKnowledgeItemRequest extends ActionRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/archive';
    }
}
