<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * An ExplorerMigrated record from TOPdesk's Knowledge Base API.
 */
readonly class ExplorerMigrated extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $migrated = null,
        public array $extra = [],
    ) {}
}
