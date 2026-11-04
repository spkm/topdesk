<?php

namespace spkm\Topdesk\Requests\KnowledgeItemStatuses;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\KnowledgeBase\Searchlist;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates the knowledge item status: PATCH /services/knowledge-base-v1/knowledgeItemStatuses/{identifier}.
 *
 * Updates the knowledge item status. It is necessary to have the permission to update the Knowledge Base settings.
 */
class UpdateKnowledgeItemStatusRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::ONE;

    protected ?string $dto = Searchlist::class;

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
        return '/services/knowledge-base-v1/knowledgeItemStatuses/'.Path::segment((string) $this->identifier);
    }
}
