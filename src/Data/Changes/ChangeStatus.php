<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A ChangeStatus record from TOPdesk's Change Management API.
 */
readonly class ChangeStatus extends Data
{
    /**
     * @param  array<mixed>|null  $defaultFor
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $prfc = null,
        public ?string $rfc = null,
        public ?string $simple = null,
        public ?string $extensive = null,
        public ?bool $archived = null,
        public ?array $defaultFor = null,
        public array $extra = [],
    ) {}
}
