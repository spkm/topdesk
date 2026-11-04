<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An AssignmentRequest record from TOPdesk's Asset Management API.
 */
readonly class AssignmentRequest extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $branchId = null,
        public ?string $linkToId = null,
        public ?string $linkType = null,
        public array $extra = [],
    ) {}
}
