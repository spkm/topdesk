<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An ErrorResponseEntity record from TOPdesk's Reservations API.
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
