<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfActivityTemplates record from TOPdesk's Change Management API.
 */
readonly class ListOfActivityTemplates extends Data
{
    protected const LISTS = ['results' => ActivityTemplate::class];

    /**
     * @param  Collection<int, ActivityTemplate>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
