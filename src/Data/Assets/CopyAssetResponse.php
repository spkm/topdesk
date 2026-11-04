<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A CopyAssetResponse record from TOPdesk's Asset Management API.
 */
readonly class CopyAssetResponse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $creationDate = null,
        public ?string $name = null,
        public ?string $unid = null,
        public array $extra = [],
    ) {}
}
