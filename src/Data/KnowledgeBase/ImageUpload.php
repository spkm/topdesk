<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * An ImageUpload record from TOPdesk's Knowledge Base API.
 */
readonly class ImageUpload extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $file = null,
        public array $extra = [],
    ) {}
}
