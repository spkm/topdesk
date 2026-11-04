<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A LinkStatisticsResponse record from TOPdesk's Asset Management API.
 */
readonly class LinkStatisticsResponse extends Data
{
    protected const LISTS = ['dataSet' => LinkStatisticsItem::class];

    /**
     * @param  Collection<int, LinkStatisticsItem>|null  $dataSet
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $dataSet = null,
        public array $extra = [],
    ) {}
}
