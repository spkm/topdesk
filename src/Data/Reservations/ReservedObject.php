<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A Reserved Object record from TOPdesk's Reservations API.
 */
readonly class ReservedObject extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?SearchList $type = null,
        public ?SearchList $make = null,
        public ?SearchList $model = null,
        public array $extra = [],
    ) {}
}
