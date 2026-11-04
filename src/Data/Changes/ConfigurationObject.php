<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A ConfigurationObject record from TOPdesk's Change Management API.
 */
readonly class ConfigurationObject extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $objectId = null,
        public ?string $objectType = null,
        public array $extra = [],
    ) {}
}
