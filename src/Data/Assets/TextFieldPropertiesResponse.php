<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A TextFieldPropertiesResponse record from TOPdesk's Asset Management API.
 *
 * Properties for text fields
 */
readonly class TextFieldPropertiesResponse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?int $maxLength = null,
        public ?bool $multilineSupport = null,
        public array $extra = [],
    ) {}
}
