<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An AddFacilityDto record from TOPdesk's Reservations API.
 */
readonly class AddFacilityDto extends Data
{
    protected const LISTS = ['add' => ReservedFacilityLookup::class];

    /**
     * @param  Collection<int, ReservedFacilityLookup>|null  $add
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $add = null,
        public array $extra = [],
    ) {}
}
