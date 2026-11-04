<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfRequestEntries record from TOPdesk's Change Management API.
 */
readonly class ListOfRequestEntries extends Data
{
    protected const LISTS = ['results' => RequestEntry::class];

    /**
     * @param  Collection<int, RequestEntry>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
