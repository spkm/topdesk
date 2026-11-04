<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * An UpdateStep record from TOPdesk's Change Management API.
 */
readonly class UpdateStep extends Data
{
    /**
     * @param  array<string, mixed>|null  $value
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $op = null,
        public ?string $path = null,
        public ?array $value = null,
        public ?string $from = null,
        public array $extra = [],
    ) {}
}
