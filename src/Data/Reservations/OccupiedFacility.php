<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An Occupied Facility record from TOPdesk's Reservations API.
 */
readonly class OccupiedFacility extends Data
{
    protected const LISTS = ['occupancy' => Occupancy::class];

    /**
     * @param  Collection<int, Occupancy>|null  $occupancy
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?Branch $branch = null,
        public ?Collection $occupancy = null,
        public array $extra = [],
    ) {}
}
