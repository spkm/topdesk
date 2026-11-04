<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * A KnowledgeItemContent record from TOPdesk's Knowledge Base API.
 *
 * Represents the content of a Knowledge Item in a specific language.
 */
readonly class KnowledgeItemContent extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?string $content = null,
        public ?string $commentsForOperators = null,
        public ?string $keywords = null,
        public array $extra = [],
    ) {}
}
