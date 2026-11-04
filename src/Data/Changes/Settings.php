<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A Settings record from TOPdesk's Change Management API.
 */
readonly class Settings extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $processingStatusDeterminedByStatus = null,
        public array $extra = [],
    ) {}
}
