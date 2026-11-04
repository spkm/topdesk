<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A StockQuantitiesResponse record from TOPdesk's Asset Management API.
 */
readonly class StockQuantitiesResponse extends Data
{
    protected const LISTS = ['dataSet' => StockQuantitiesItem::class];

    /**
     * @param  Collection<int, StockQuantitiesItem>|null  $dataSet
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $dataSet = null,
        public ?int $total = null,
        public array $extra = [],
    ) {}
}
