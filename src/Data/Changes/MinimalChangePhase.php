<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A MinimalChangePhase record from TOPdesk's Change Management API.
 */
readonly class MinimalChangePhase extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?AssigneeDetails $authorizer = null,
        public array $extra = [],
    ) {}
}
