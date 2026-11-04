<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * An UpdateKnowledgeItemParams record from TOPdesk's Knowledge Base API.
 *
 * Defines the updatable fields of a Knowledge Item.
 */
readonly class UpdateKnowledgeItemParams extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?VisibilityWrite $visibility = null,
        public ?Identifier $status = null,
        public ?Identifier $manager = null,
        public ?ExternalLink $externalLink = null,
        public array $extra = [],
    ) {}
}
