<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A Reserved Location record from TOPdesk's Reservations API.
 */
readonly class ReservedLocation extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $roomNumber = null,
        public ?Branch $branch = null,
        public ?SearchList $roomType = null,
        public array $extra = [],
    ) {}
}
