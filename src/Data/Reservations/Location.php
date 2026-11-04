<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A Location record from TOPdesk's Reservations API.
 */
readonly class Location extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?Branch $branch = null,
        public ?string $name = null,
        public ?string $roomNumber = null,
        public ?int $capacity = null,
        public array $extra = [],
    ) {}
}
