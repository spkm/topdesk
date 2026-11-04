<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A HistoryItemCollection record from TOPdesk's Asset Management API.
 */
readonly class HistoryItemCollection extends Data
{
    protected const LISTS = ['items' => HistoryItem::class];

    /**
     * @param  Collection<int, HistoryItem>|null  $items
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $items = null,
        public ?string $next = null,
        public array $extra = [],
    ) {}
}
