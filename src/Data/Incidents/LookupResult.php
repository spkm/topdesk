<?php

namespace spkm\Topdesk\Data\Incidents;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A LookupResult record from TOPdesk's Incident Management API.
 */
readonly class LookupResult extends Data
{
    protected const LISTS = ['results' => Searchlist::class];

    /**
     * @param  Collection<int, Searchlist>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
