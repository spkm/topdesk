<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use spkm\Topdesk\Data\Data;

/**
 * A SubcategoryForCreation record from TOPdesk's Operations Management API.
 */
readonly class SubcategoryForCreation extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public mixed $name = null,
        public array $extra = [],
    ) {}
}
