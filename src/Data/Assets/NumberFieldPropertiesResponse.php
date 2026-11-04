<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A NumberFieldPropertiesResponse record from TOPdesk's Asset Management API.
 *
 * Properties for number fields
 */
readonly class NumberFieldPropertiesResponse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?int $decimals = null,
        public ?bool $isCurrency = null,
        public ?float $maxValue = null,
        public ?float $minValue = null,
        public array $extra = [],
    ) {}
}
