<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A DropdownOptionResults record from TOPdesk's Asset Management API.
 */
readonly class DropdownOptionResults extends Data
{
    protected const LISTS = ['results' => DropdownOption::class];

    /**
     * @param  Collection<int, DropdownOption>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
