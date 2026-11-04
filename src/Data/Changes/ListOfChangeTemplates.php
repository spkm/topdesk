<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfChangeTemplates record from TOPdesk's Change Management API.
 */
readonly class ListOfChangeTemplates extends Data
{
    protected const LISTS = ['results' => ChangeTemplate::class];

    /**
     * @param  Collection<int, ChangeTemplate>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
