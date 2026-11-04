<?php

namespace spkm\Topdesk\Data\Visitors;

use spkm\Topdesk\Data\Data;

/**
 * An UpdateSearchlistDto record from TOPdesk's Visitor Registration API.
 */
readonly class UpdateSearchlistDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
