<?php

namespace spkm\Topdesk\Data\KnowledgeBaseGraphql;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A KnowledgeItem record from TOPdesk's Knowledge Base (GraphQL) API.
 */
readonly class KnowledgeItem extends Data
{
    protected const LISTS = ['translations' => KnowledgeItemTranslation::class];

    /**
     * @param  Collection<int, KnowledgeItemTranslation>|null  $translations
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?Collection $translations = null,
        public array $extra = [],
    ) {}
}
