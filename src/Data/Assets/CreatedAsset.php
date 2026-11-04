<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A CreatedAsset record from TOPdesk's Asset Management API.
 *
 * A flat json object representing the created asset.
 */
readonly class CreatedAsset extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public array $extra = [],
    ) {}
}
