<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Adds feedback to the given Knowledge Item: POST
 * /services/knowledge-base-v1/knowledgeItems/{identifier}/giveFeedback.
 *
 * Adds feedback for the given Knowledge Item.
 */
class GiveFeedbackKnowledgeItemRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    protected ?string $contentType = 'application/x.topdesk-kb-give-feedback-v1+json';

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
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/giveFeedback';
    }
}
