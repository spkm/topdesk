<?php

namespace spkm\Topdesk\Data\Visitors;

use spkm\Topdesk\Data\Data;

/**
 * A CreateSearchlistDto record from TOPdesk's Visitor Registration API.
 */
readonly class CreateSearchlistDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public ?bool $archived = null,
        public array $extra = [],
    ) {}
}
