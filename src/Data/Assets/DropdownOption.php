<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A DropdownOption record from TOPdesk's Asset Management API.
 *
 * A flat json object representing a single dropdown option. The keys are field IDs ("id", and "name" if requested
 * using the "field" query parameter), and the values are the dropdown option's values for those fields.
 */
readonly class DropdownOption extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
