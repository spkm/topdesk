<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An OneServiceToManyAssetsRequest record from TOPdesk's Asset Management API.
 */
readonly class OneServiceToManyAssetsRequest extends Data
{
    /**
     * @param  array<mixed>|null  $assetIds
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $assetIds = null,
        public ?string $serviceId = null,
        public array $extra = [],
    ) {}
}
