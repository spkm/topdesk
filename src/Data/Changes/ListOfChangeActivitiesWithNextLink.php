<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfChangeActivitiesWithNextLink record from TOPdesk's Change Management API.
 */
readonly class ListOfChangeActivitiesWithNextLink extends Data
{
    protected const LISTS = ['results' => ChangeActivityEntry::class];

    /**
     * @param  Collection<int, ChangeActivityEntry>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public ?string $next = null,
        public array $extra = [],
    ) {}
}
