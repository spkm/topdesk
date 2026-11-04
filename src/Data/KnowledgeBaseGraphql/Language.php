<?php

namespace spkm\Topdesk\Data\KnowledgeBaseGraphql;

use spkm\Topdesk\Data\Data;

/**
 * A Language record from TOPdesk's Knowledge Base (GraphQL) API.
 */
readonly class Language extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $languageCode = null,
        public array $extra = [],
    ) {}
}
