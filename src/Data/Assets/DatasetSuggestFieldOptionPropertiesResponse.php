<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A DatasetSuggestFieldOptionPropertiesResponse record from TOPdesk's Asset Management API.
 *
 * Properties for dataset suggest field
 */
readonly class DatasetSuggestFieldOptionPropertiesResponse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $optionListType = null,
        public array $extra = [],
    ) {}
}
