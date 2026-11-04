<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A Person record from TOPdesk's Asset Management API.
 *
 * Properties of the assigned person.
 */
readonly class Person extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $archived = null,
        public ?string $avatar = null,
        public ?string $branchName = null,
        public ?string $function = null,
        public ?string $id = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
