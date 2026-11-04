<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A SimpleFunctionality record from TOPdesk's Asset Management API.
 */
readonly class SimpleFunctionality extends Data
{
    /**
     * @param  array<string, mixed>|null  $parameters
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public ?array $parameters = null,
        public array $extra = [],
    ) {}
}
