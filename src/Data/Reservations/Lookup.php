<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A Lookup record from TOPdesk's Reservations API.
 */
readonly class Lookup extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public array $extra = [],
    ) {}
}
