<?php

namespace spkm\Topdesk\Data\KnowledgeBaseGraphql;

use spkm\Topdesk\Data\Data;

/**
 * A KnowledgeItemTranslation record from TOPdesk's Knowledge Base (GraphQL) API.
 */
readonly class KnowledgeItemTranslation extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $languageId = null,
        public ?string $knowledgeItemId = null,
        public ?string $title = null,
        public ?string $description = null,
        public ?string $content = null,
        public array $extra = [],
    ) {}
}
