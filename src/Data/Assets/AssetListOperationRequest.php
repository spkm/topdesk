<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An AssetListOperationRequest record from TOPdesk's Asset Management API.
 */
readonly class AssetListOperationRequest extends Data
{
    /**
     * @param  array<mixed>|null  $unids
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $unids = null,
        public array $extra = [],
    ) {}
}
