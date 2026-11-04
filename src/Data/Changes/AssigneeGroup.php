<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * An AssigneeGroup record from TOPdesk's Change Management API.
 */
readonly class AssigneeGroup extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $type = null,
        public array $extra = [],
    ) {}
}
