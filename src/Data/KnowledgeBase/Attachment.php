<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An Attachment record from TOPdesk's Knowledge Base API.
 */
readonly class Attachment extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $filename = null,
        public ?string $description = null,
        public ?int $size = null,
        public ?CarbonImmutable $uploadDate = null,
        public ?string $uploadedBy = null,
        public array $extra = [],
    ) {}
}
