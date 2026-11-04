<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A BulkAssignmentRequest record from TOPdesk's Asset Management API.
 */
readonly class BulkAssignmentRequest extends Data
{
    /**
     * @param  array<mixed>|null  $assetIds
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $assetIds = null,
        public ?string $branchId = null,
        public ?string $linkToId = null,
        public ?string $linkType = null,
        public array $extra = [],
    ) {}
}
