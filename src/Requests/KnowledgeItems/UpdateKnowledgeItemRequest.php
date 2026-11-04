<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates properties of the Knowledge Item: PATCH /services/knowledge-base-v1/knowledgeItems/{identifier}.
 *
 * Updates the Knowledge Item with the given identifier.
 */
class UpdateKnowledgeItemRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::NONE;

    protected ?string $contentType = 'application/x.topdesk-kb-update-ki-v1+json';

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
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier);
    }
}
