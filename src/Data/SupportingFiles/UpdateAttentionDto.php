<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An UpdateAttentionDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdateAttentionDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $comment = null,
        public array $extra = [],
    ) {}
}
