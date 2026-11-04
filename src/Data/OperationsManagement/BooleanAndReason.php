<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use spkm\Topdesk\Data\Data;

/**
 * A booleanAndReason record from TOPdesk's Operations Management API.
 */
readonly class BooleanAndReason extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $value = null,
        public ?IdAndName $reason = null,
        public array $extra = [],
    ) {}
}
