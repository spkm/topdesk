<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use spkm\Topdesk\Data\Data;

/**
 * An ErrorDescription record from TOPdesk's Knowledge Base API.
 */
readonly class ErrorDescription extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $errorCode = null,
        public ?string $appliesTo = null,
        public ?string $errorMessage = null,
        public array $extra = [],
    ) {}
}
