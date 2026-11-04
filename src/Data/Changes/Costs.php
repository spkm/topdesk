<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A Costs record from TOPdesk's Change Management API.
 */
readonly class Costs extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?float $value = null,
        public ?string $currencyPrefix = null,
        public ?string $currencySuffix = null,
        public array $extra = [],
    ) {}
}
