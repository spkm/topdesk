<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A ModifiedAssetResponse record from TOPdesk's Asset Management API.
 */
readonly class ModifiedAssetResponse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $modified = null,
        public array $extra = [],
    ) {}
}
