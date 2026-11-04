<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * An ExternalLink record from TOPdesk's Incident Management API.
 */
readonly class ExternalLink extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $type = null,
        public ?string $date = null,
        public array $extra = [],
    ) {}
}
