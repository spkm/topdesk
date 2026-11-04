<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A KnowledgeItemList record from TOPdesk's Knowledge Base API.
 */
readonly class KnowledgeItemList extends Data
{
    protected const LISTS = ['item' => KnowledgeItem::class];

    /**
     * @param  Collection<int, KnowledgeItem>|null  $item
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $item = null,
        public ?string $prev = null,
        public ?string $next = null,
        public array $extra = [],
    ) {}
}
