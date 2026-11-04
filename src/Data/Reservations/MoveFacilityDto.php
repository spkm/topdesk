<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A MoveFacilityDto record from TOPdesk's Reservations API.
 */
readonly class MoveFacilityDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?ReservedFacilityLookup $from = null,
        public ?ReservedFacilityLookup $to = null,
        public array $extra = [],
    ) {}
}
