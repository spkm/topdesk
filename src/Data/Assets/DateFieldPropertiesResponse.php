<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A DateFieldPropertiesResponse record from TOPdesk's Asset Management API.
 *
 * Properties for date fields
 */
readonly class DateFieldPropertiesResponse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $showTime = null,
        public array $extra = [],
    ) {}
}
