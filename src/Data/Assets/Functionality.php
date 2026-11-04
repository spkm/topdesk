<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A Functionality record from TOPdesk's Asset Management API.
 */
readonly class Functionality extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $enabled = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
