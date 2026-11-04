<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use spkm\Topdesk\Data\Data;

/**
 * A Types record from TOPdesk's Operations Management API.
 *
 * Type for an operational activity
 */
readonly class Types extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?bool $archived = null,
        public array $extra = [],
    ) {}
}
