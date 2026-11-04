<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ValidationErrorsResponse record from TOPdesk's Asset Management API.
 */
readonly class ValidationErrorsResponse extends Data
{
    protected const LISTS = ['errors' => FrontendValidationProblem::class];

    /**
     * @param  Collection<int, FrontendValidationProblem>|null  $errors
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $errors = null,
        public array $extra = [],
    ) {}
}
