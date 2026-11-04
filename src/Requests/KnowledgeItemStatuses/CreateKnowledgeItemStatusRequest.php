<?php

namespace spkm\Topdesk\Requests\KnowledgeItemStatuses;

use JsonSerializable;
use spkm\Topdesk\Data\KnowledgeBase\Searchlist;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Creates a knowledge item status: POST /services/knowledge-base-v1/knowledgeItemStatuses.
 *
 * Creates a knowledge item status. It is necessary to have the permission to update the Knowledge Base settings.
 */
class CreateKnowledgeItemStatusRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = Searchlist::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItemStatuses';
    }
}
