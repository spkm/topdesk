<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfManagerAuthorizables record from TOPdesk's Change Management API.
 */
readonly class ListOfManagerAuthorizables extends Data
{
    protected const LISTS = ['results' => ManagerAuthorizableEntry::class];

    /**
     * @param  Collection<int, ManagerAuthorizableEntry>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public ?int $totalCount = null,
        public array $extra = [],
    ) {}
}
