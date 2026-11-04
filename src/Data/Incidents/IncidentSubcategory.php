<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * An IncidentSubcategory record from TOPdesk's Incident Management API.
 */
readonly class IncidentSubcategory extends Data
{
    /**
     * @param  array<string, mixed>|null  $category
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?array $category = null,
        public array $extra = [],
    ) {}
}
