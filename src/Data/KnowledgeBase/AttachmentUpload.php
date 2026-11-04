<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * An AttachmentUpload record from TOPdesk's Knowledge Base API.
 */
readonly class AttachmentUpload extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $file = null,
        public ?string $description = null,
        public array $extra = [],
    ) {}
}
