<?php

namespace spkm\Topdesk\Data\CustomActions;

use spkm\Topdesk\Data\Data;

/**
 * A BarcodeCreateContent record from TOPdesk's Custom Action Support API.
 */
readonly class BarcodeCreateContent extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $text = null,
        public ?string $header = null,
        public ?string $footer = null,
        public array $extra = [],
    ) {}
}
