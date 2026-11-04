<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use JsonSerializable;
use spkm\Topdesk\Data\KnowledgeBase\KnowledgeItemReference;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Creates a Knowledge Item with given content: POST /services/knowledge-base-v1/knowledgeItems.
 *
 * Creates a Knowledge Item with given content. The parent is mandatory and must reference a Folder. It is necessary to
 * have the permission to create Knowledge Items. In order for an operator / operator group to be assigned as manager,
 * the "Knowledge Base Manager" task must be selected in the Supporting Files module.
 */
class CreateKnowledgeItemRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = KnowledgeItemReference::class;

    protected ?string $accept = 'application/x.topdesk-kb-ki-created-v1+json';

    protected ?string $contentType = 'application/x.topdesk-kb-create-ki-v1+json';

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
        return '/services/knowledge-base-v1/knowledgeItems';
    }
}
