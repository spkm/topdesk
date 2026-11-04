<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A DropdownOptionName record from TOPdesk's Asset Management API.
 *
 * An object representing the name of a dropdown option.
 */
readonly class DropdownOptionName extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
