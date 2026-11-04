<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An ErrorResponseEntity record from TOPdesk's Supporting Files API.
 */
readonly class ErrorResponseEntity extends Data
{
    protected const LISTS = ['errors' => ErrorDescription::class];

    /**
     * @param  Collection<int, ErrorDescription>|null  $errors
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $errors = null,
        public array $extra = [],
    ) {}
}
