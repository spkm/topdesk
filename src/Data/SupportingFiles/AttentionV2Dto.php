<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An AttentionV2Dto record from TOPdesk's Supporting Files API.
 */
readonly class AttentionV2Dto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $comment = null,
        public array $extra = [],
    ) {}
}
