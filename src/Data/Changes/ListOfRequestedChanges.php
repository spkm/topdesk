<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfRequestedChanges record from TOPdesk's Change Management API.
 */
readonly class ListOfRequestedChanges extends Data
{
    protected const LISTS = ['results' => RequestedChangeEntry::class];

    /**
     * @param  Collection<int, RequestedChangeEntry>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public ?string $next = null,
        public array $extra = [],
    ) {}
}
