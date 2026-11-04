<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A Branch record from TOPdesk's Asset Management API.
 *
 * Properties of the linked branch
 */
readonly class Branch extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $archived = null,
        public ?string $id = null,
        public ?string $name = null,
        public ?string $specification = null,
        public array $extra = [],
    ) {}
}
