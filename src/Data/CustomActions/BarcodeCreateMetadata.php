<?php

namespace spkm\Topdesk\Data\CustomActions;

use spkm\Topdesk\Data\Data;

/**
 * A BarcodeCreateMetadata record from TOPdesk's Custom Action Support API.
 */
readonly class BarcodeCreateMetadata extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $format = null,
        public ?int $width = null,
        public ?int $height = null,
        public ?string $imageType = null,
        public array $extra = [],
    ) {}
}
