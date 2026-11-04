<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchives the Knowledge Item: POST /services/knowledge-base-v1/knowledgeItems/{identifier}/unarchive.
 *
 * Unarchives the Knowledge Item with the given identifier. The Knowledge Item can only be unarchived if the parent
 * folder is not archived. If the Knowledge Item is already unarchived nothing will change. It is necessary to have the
 * permission to update and archive Knowledge Items.
 */
class UnarchiveKnowledgeItemRequest extends ActionRequest
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
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/unarchive';
    }
}
