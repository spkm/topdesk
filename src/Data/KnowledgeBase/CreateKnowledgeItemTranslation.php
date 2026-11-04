<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * A CreateKnowledgeItemTranslation record from TOPdesk's Knowledge Base API.
 *
 * Represents a translation of a Knowledge Item, with the translated content. When creating a translation, title is a
 * mandatory field.
 */
readonly class CreateKnowledgeItemTranslation extends Data
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
