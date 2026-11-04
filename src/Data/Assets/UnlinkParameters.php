<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An UnlinkParameters record from TOPdesk's Asset Management API.
 */
readonly class UnlinkParameters extends Data
{
    /**
     * @param  array<mixed>|null  $assetIds
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $assetIds = null,
        public array $extra = [],
    ) {}
}
