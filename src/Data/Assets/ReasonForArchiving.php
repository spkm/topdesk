<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A ReasonForArchiving record from TOPdesk's Asset Management API.
 */
readonly class ReasonForArchiving extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $reasonId = null,
        public array $extra = [],
    ) {}
}
