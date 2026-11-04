<?php

namespace spkm\Topdesk\Requests\KnowledgeItemStatuses;

use spkm\Topdesk\Data\KnowledgeBase\Searchlist;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archives the knowledge item status: POST /services/knowledge-base-v1/knowledgeItemStatuses/{identifier}/archive.
 *
 * Archives the knowledge item status. It is necessary to have the permission to update the Knowledge Base settings.
 */
class ArchiveKnowledgeItemStatusRequest extends ActionRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = Searchlist::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItemStatuses/'.Path::segment((string) $this->identifier).'/archive';
    }
}
