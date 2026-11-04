<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A FrontendValidationProblem record from TOPdesk's Asset Management API.
 */
readonly class FrontendValidationProblem extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $fieldName = null,
        public ?string $fieldTitle = null,
        public ?string $message = null,
        public array $extra = [],
    ) {}
}
