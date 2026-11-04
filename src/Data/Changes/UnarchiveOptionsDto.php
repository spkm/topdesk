<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * An UnarchiveOptionsDto record from TOPdesk's Change Management API.
 */
readonly class UnarchiveOptionsDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $unarchiveActivities = null,
        public array $extra = [],
    ) {}
}
