<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A ReservedAsset record from TOPdesk's Reservations API.
 */
readonly class ReservedAsset2 extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?LookupByName $asset = null,
        public array $extra = [],
    ) {}
}
