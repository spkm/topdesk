<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use spkm\Topdesk\Data\Data;

/**
 * A LinkedLocation record from TOPdesk's Operations Management API.
 */
readonly class LinkedLocation extends Data
{
    /**
     * @param  array<string, mixed>|null  $branch
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?array $branch = null,
        public array $extra = [],
    ) {}
}
