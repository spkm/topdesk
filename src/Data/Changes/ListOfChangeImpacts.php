<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfChangeImpacts record from TOPdesk's Change Management API.
 */
readonly class ListOfChangeImpacts extends Data
{
    protected const LISTS = ['results' => ChangeImpact::class];

    /**
     * @param  Collection<int, ChangeImpact>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
