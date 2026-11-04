<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A List of Locations record from TOPdesk's Reservations API.
 */
readonly class ListOfLocations extends Data
{
    protected const LISTS = ['results' => Location::class];

    /**
     * @param  Collection<int, Location>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
