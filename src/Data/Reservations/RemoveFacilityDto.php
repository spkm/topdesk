<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A RemoveFacilityDto record from TOPdesk's Reservations API.
 */
readonly class RemoveFacilityDto extends Data
{
    protected const LISTS = ['remove' => ReservedFacilityLookup::class];

    /**
     * @param  Collection<int, ReservedFacilityLookup>|null  $remove
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $remove = null,
        public array $extra = [],
    ) {}
}
