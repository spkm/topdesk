<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * A ProcessingStatus record from TOPdesk's Incident Management API.
 */
readonly class ProcessingStatus extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $onHold = null,
        public ?string $processingState = null,
        public ?string $response = null,
        public ?bool $default = null,
        public array $extra = [],
    ) {}
}
