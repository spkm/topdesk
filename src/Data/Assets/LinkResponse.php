<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A LinkResponse record from TOPdesk's Asset Management API.
 *
 * A link between the requested entity and an asset.
 */
readonly class LinkResponse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $assetId = null,
        public ?string $linkId = null,
        public array $extra = [],
    ) {}
}
