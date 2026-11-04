<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An OrderedItemResultList record from TOPdesk's Change Management API.
 */
readonly class OrderedItemResultList extends Data
{
    protected const LISTS = ['results' => OrderedItemResultDto::class];

    /**
     * @param  Collection<int, OrderedItemResultDto>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
