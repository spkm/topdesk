<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A BadRequestEntity record from TOPdesk's Asset Management API.
 */
readonly class BadRequestEntity extends Data
{
    protected const LISTS = ['errors' => BadRequestErrorDescription::class];

    /**
     * @param  Collection<int, BadRequestErrorDescription>|null  $errors
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $errors = null,
        public array $extra = [],
    ) {}
}
