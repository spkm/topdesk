<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A DeleteGridAssetResponse record from TOPdesk's Asset Management API.
 */
readonly class DeleteGridAssetResponse extends Data
{
    /**
     * @param  array<mixed>|null  $deleted
     * @param  array<mixed>|null  $failed
     * @param  array<mixed>|null  $missing
     * @param  array<mixed>|null  $unauthorized
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $deleted = null,
        public ?string $etag = null,
        public ?array $failed = null,
        public ?array $missing = null,
        public ?array $unauthorized = null,
        public array $extra = [],
    ) {}
}
