<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Moves the Knowledge Item under a different parent Folder: POST
 * /services/knowledge-base-v1/knowledgeItems/{identifier}/move.
 *
 * Moves the Knowledge Item with the given identifier to the specified parent Folder. It is necessary to have the
 * permission to update Knowledge Items.
 */
class MoveKnowledgeItemRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    protected ?string $contentType = 'application/x.topdesk-kb-move-ki-v1+json';

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/move';
    }
}
