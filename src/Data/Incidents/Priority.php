<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * A Priority record from TOPdesk's Incident Management API.
 */
readonly class Priority extends Data
{
    /**
     * @param  array<string, mixed>|null  $firstLineDuration
     * @param  array<string, mixed>|null  $secondLineDuration
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?array $firstLineDuration = null,
        public ?array $secondLineDuration = null,
        public array $extra = [],
    ) {}
}
