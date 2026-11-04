<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A List_of_Lookup_Entries record from TOPdesk's Supporting Files API.
 */
readonly class ListOfLookupEntries extends Data
{
    protected const LISTS = ['results' => LookupEntry::class];

    /**
     * @param  Collection<int, LookupEntry>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
