<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * A RequesterIncidentCreateBody record from TOPdesk's Incident Management API.
 */
readonly class RequesterIncidentCreateBody extends Data
{
    /**
     * @param  array<string, mixed>|null  $callType
     * @param  array<string, mixed>|null  $category
     * @param  array<string, mixed>|null  $subcategory
     * @param  array<string, mixed>|null  $object
     * @param  array<string, mixed>|null  $location
     * @param  array<string, mixed>|null  $operatorGroup
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $briefDescription = null,
        public ?string $request = null,
        public ?array $callType = null,
        public ?array $category = null,
        public ?array $subcategory = null,
        public ?array $object = null,
        public ?array $location = null,
        public ?array $operatorGroup = null,
        public array $extra = [],
    ) {}
}
