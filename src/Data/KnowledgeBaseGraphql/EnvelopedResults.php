<?php

namespace spkm\Topdesk\Data\KnowledgeBaseGraphql;

use spkm\Topdesk\Data\Data;

/**
 * An EnvelopedResults record from TOPdesk's Knowledge Base (GraphQL) API.
 */
readonly class EnvelopedResults extends Data
{
    /**
     * @param  array<string, mixed>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $results = null,
        public array $extra = [],
    ) {}
}
