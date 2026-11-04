<?php

namespace spkm\Topdesk\Data\Visitors;

use spkm\Topdesk\Data\Data;

/**
 * A HALLink record from TOPdesk's Visitor Registration API.
 */
readonly class HALLink extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $href = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
