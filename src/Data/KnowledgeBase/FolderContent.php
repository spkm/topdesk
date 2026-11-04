<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * A FolderContent record from TOPdesk's Knowledge Base API.
 *
 * Represents the content of a Folder in a specific language.
 */
readonly class FolderContent extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public array $extra = [],
    ) {}
}
