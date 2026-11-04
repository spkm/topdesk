<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An Operator record from TOPdesk's Asset Management API.
 *
 * The operator, who uploaded the file
 */
readonly class Operator extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $dynamicName = null,
        public ?string $id = null,
        public array $extra = [],
    ) {}
}
