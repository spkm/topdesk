<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A ReservedFacilityLookup record from TOPdesk's Reservations API.
 */
readonly class ReservedFacilityLookup extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Lookup $location = null,
        public ?LookupByName $object = null,
        public ?LookupByName $asset = null,
        public array $extra = [],
    ) {}
}
