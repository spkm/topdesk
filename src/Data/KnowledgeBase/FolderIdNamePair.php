<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * A FolderIdNamePair record from TOPdesk's Knowledge Base API.
 *
 * An ID or a number referencing a folder.
 */
readonly class FolderIdNamePair extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public array $extra = [],
    ) {}
}
