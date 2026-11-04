<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A DropdownOptionId record from TOPdesk's Asset Management API.
 *
 * An object representing the ID of a dropdown option.
 */
readonly class DropdownOptionId extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public array $extra = [],
    ) {}
}
