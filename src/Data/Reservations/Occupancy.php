<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * An Occupancy record from TOPdesk's Reservations API.
 */
readonly class Occupancy extends Data
{
    /**
     * @param  array<string, mixed>|null  $start
     * @param  array<string, mixed>|null  $end
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $interval = null,
        public ?array $start = null,
        public ?array $end = null,
        public ?float $rate = null,
        public array $extra = [],
    ) {}
}
