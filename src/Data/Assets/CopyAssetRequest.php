<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A CopyAssetRequest record from TOPdesk's Asset Management API.
 */
readonly class CopyAssetRequest extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?int $numberOfCopies = null,
        public ?string $prefix = null,
        public ?string $startAt = null,
        public array $extra = [],
    ) {}
}
