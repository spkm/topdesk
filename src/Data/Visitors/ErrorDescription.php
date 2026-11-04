<?php

namespace spkm\Topdesk\Data\Visitors;

use spkm\Topdesk\Data\Data;

/**
 * An ErrorDescription record from TOPdesk's Visitor Registration API.
 */
readonly class ErrorDescription extends Data
{
    /**
     * @param  array<mixed>|null  $appliesTo
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $errorCode = null,
        public ?array $appliesTo = null,
        public ?string $errorMessage = null,
        public array $extra = [],
    ) {}
}
