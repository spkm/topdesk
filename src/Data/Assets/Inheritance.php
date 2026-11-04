<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An Inheritance record from TOPdesk's Asset Management API.
 *
 * Inheritance settings
 */
readonly class Inheritance extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $location = null,
        public ?bool $person = null,
        public array $extra = [],
    ) {}
}
