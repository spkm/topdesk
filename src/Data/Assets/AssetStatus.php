<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An AssetStatus record from TOPdesk's Asset Management API.
 *
 * A flat json object representing a single asset status.
 */
readonly class AssetStatus extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
