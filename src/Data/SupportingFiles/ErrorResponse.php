<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An ErrorResponse record from TOPdesk's Supporting Files API.
 */
readonly class ErrorResponse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $message = null,
        public array $extra = [],
    ) {}
}
