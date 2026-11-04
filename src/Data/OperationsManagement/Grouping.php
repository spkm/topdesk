<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use spkm\Topdesk\Data\Data;

/**
 * A grouping record from TOPdesk's Operations Management API.
 */
readonly class Grouping extends Data
{
    /**
     * @param  array<string, mixed>|null  $schema
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?bool $archived = null,
        public ?array $schema = null,
        public array $extra = [],
    ) {}
}
