<?php

namespace spkm\Topdesk\Data\Services;

use spkm\Topdesk\Data\Data;

/**
 * An AssetToBeLinked record from TOPdesk's Services API.
 */
readonly class AssetToBeLinked extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $assetId = null,
        public array $extra = [],
    ) {}
}
