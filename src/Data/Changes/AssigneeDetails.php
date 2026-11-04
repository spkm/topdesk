<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * An AssigneeDetails record from TOPdesk's Change Management API.
 */
readonly class AssigneeDetails extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $groupId = null,
        public ?string $type = null,
        public array $extra = [],
    ) {}
}
