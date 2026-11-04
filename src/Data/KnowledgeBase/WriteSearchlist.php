<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * A WriteSearchlist record from TOPdesk's Knowledge Base API.
 */
readonly class WriteSearchlist extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
