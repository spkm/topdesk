<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An Occupancy per Facility record from TOPdesk's Reservations API.
 */
readonly class OccupancyPerFacility extends Data
{
    protected const LISTS = ['results' => OccupiedFacility::class];

    /**
     * @param  Collection<int, OccupiedFacility>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
