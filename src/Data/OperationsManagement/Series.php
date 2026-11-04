<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use spkm\Topdesk\Data\Data;

/**
 * A series record from TOPdesk's Operations Management API.
 */
readonly class Series extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $briefDescription = null,
        public ?string $number = null,
        public array $extra = [],
    ) {}
}
