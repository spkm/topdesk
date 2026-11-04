<?php

namespace spkm\Topdesk\Data\Settings;

use spkm\Topdesk\Data\Data;

/**
 * A currencyResponse record from TOPdesk's Settings API.
 */
readonly class CurrencyResponse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $currencyPrefix = null,
        public ?string $currencyPostfix = null,
        public array $extra = [],
    ) {}
}
