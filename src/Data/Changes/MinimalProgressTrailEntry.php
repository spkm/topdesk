<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A MinimalProgressTrailEntry record from TOPdesk's Change Management API.
 */
readonly class MinimalProgressTrailEntry extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $memoText = null,
        public ?string $textFormatting = null,
        public ?string $type = null,
        public ?bool $invisibleForCaller = null,
        public array $extra = [],
    ) {}
}
