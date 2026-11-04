<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A Requester record from TOPdesk's Reservations API.
 */
readonly class Requester extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?Branch $branch = null,
        public ?string $name = null,
        public ?string $email = null,
        public ?string $telephone = null,
        public array $extra = [],
    ) {}
}
