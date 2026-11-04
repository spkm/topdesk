<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfOrderedItems record from TOPdesk's Change Management API.
 */
readonly class ListOfOrderedItems extends Data
{
    protected const LISTS = ['results' => OrderedItem::class];

    /**
     * @param  Collection<int, OrderedItem>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public ?string $currencyPrefix = null,
        public ?string $currencySuffix = null,
        public array $extra = [],
    ) {}
}
