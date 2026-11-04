<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A ListRequester record from TOPdesk's Change Management API.
 */
readonly class ListRequester extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?NameIdPair $branch = null,
        public ?NameIdPair $location = null,
        public ?NameIdPair $department = null,
        public ?NameIdPair $budgetHolder = null,
        public array $extra = [],
    ) {}
}
