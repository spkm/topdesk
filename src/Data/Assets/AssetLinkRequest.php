<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An AssetLinkRequest record from TOPdesk's Asset Management API.
 *
 * Directional link to be added between two assets
 */
readonly class AssetLinkRequest extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $capabilityId = null,
        public ?string $sourceId = null,
        public ?string $targetId = null,
        public ?string $type = null,
        public array $extra = [],
    ) {}
}
