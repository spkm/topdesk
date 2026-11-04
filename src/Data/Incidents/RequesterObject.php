<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * A RequesterObject record from TOPdesk's Incident Management API.
 */
readonly class RequesterObject extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?Searchlist $type = null,
        public ?Searchlist $branch = null,
        public ?Searchlist $location = null,
        public array $extra = [],
    ) {}
}
