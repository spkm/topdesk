<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A SuggestFieldPropertiesResponse record from TOPdesk's Asset Management API.
 */
readonly class SuggestFieldPropertiesResponse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public mixed $optionProperties = null,
        public ?bool $ownOptions = null,
        public array $extra = [],
    ) {}
}
