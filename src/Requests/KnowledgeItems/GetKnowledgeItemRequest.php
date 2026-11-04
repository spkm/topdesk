<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Data\KnowledgeBase\KnowledgeItem;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the Knowledge Item by id or number: GET /services/knowledge-base-v1/knowledgeItems/{identifier}.
 *
 * Returns the Knowledge Item with the given identifier. By default, this endpoint will only return the Knowledge Item
 * which has content in the requested language. It is necessary to have the permission to read Knowledge Items. If
 * additionally the permission to update Knowledge Items is present, then branch filters do not apply.
 */
class GetKnowledgeItemRequest extends GetRequest
{
    protected ?string $dto = KnowledgeItem::class;

    protected ?string $accept = 'application/x.topdesk-kb-ki-v1+json';

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields, language.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier);
    }
}
