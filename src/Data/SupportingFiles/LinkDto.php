<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A LinkDto record from TOPdesk's Supporting Files API.
 */
readonly class LinkDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $href = null,
        public ?string $type = null,
        public array $extra = [],
    ) {}
}
