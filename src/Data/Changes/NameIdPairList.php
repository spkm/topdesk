<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A NameIdPairList record from TOPdesk's Change Management API.
 */
readonly class NameIdPairList extends Data
{
    protected const LISTS = ['results' => NameIdPair::class];

    /**
     * @param  Collection<int, NameIdPair>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
