<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A ChangeActivityParent record from TOPdesk's Change Management API.
 */
readonly class ChangeActivityParent extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public array $extra = [],
    ) {}
}
