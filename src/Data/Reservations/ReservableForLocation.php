<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A ReservableForLocation record from TOPdesk's Reservations API.
 */
readonly class ReservableForLocation extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?bool $standardService = null,
        public array $extra = [],
    ) {}
}
