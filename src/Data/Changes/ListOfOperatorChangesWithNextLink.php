<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfOperatorChangesWithNextLink record from TOPdesk's Change Management API.
 */
readonly class ListOfOperatorChangesWithNextLink extends Data
{
    protected const LISTS = ['results' => OperatorChangeEntry::class];

    /**
     * @param  Collection<int, OperatorChangeEntry>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public ?string $next = null,
        public array $extra = [],
    ) {}
}
