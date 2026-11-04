<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * A RequesterCaller record from TOPdesk's Incident Management API.
 */
readonly class RequesterCaller extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $dynamicName = null,
        public array $extra = [],
    ) {}
}
