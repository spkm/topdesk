<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * An Operator record from TOPdesk's Incident Management API.
 */
readonly class Operator extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $status = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
