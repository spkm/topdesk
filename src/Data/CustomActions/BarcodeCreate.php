<?php

namespace spkm\Topdesk\Data\CustomActions;

use spkm\Topdesk\Data\Data;

/**
 * A BarcodeCreate record from TOPdesk's Custom Action Support API.
 */
readonly class BarcodeCreate extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?BarcodeCreateMetadata $metadata = null,
        public ?BarcodeCreateContent $content = null,
        public array $extra = [],
    ) {}
}
