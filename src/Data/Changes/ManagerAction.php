<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A ManagerAction record from TOPdesk's Change Management API.
 */
readonly class ManagerAction extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $action = null,
        public ?string $reason = null,
        public ?string $comment = null,
        public array $extra = [],
    ) {}
}
