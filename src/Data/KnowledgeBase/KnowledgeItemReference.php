<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * A KnowledgeItemReference record from TOPdesk's Knowledge Base API.
 */
readonly class KnowledgeItemReference extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public array $extra = [],
    ) {}
}
