<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A listOfIdAndName record from TOPdesk's Operations Management API.
 */
readonly class ListOfIdAndName extends Data
{
    protected const LISTS = ['results' => IdAndName::class];

    /**
     * @param  Collection<int, IdAndName>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
