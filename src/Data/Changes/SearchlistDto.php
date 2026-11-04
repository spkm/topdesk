<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A SearchlistDto record from TOPdesk's Change Management API.
 */
readonly class SearchlistDto extends Data
{
    protected const LISTS = ['searchlistValues' => NameIdPair::class];

    /**
     * @param  Collection<int, NameIdPair>|null  $searchlistValues
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $searchlistValues = null,
        public array $extra = [],
    ) {}
}
