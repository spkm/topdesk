<?php

namespace spkm\Topdesk\Data\Incidents;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A CreateTimeSpent record from TOPdesk's Incident Management API.
 */
readonly class CreateTimeSpent extends Data
{
    /**
     * @param  array<string, mixed>|null  $operator
     * @param  array<string, mixed>|null  $operatorGroup
     * @param  array<string, mixed>|null  $reason
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?int $timeSpent = null,
        public ?string $notes = null,
        public ?CarbonImmutable $entryDate = null,
        public ?array $operator = null,
        public ?array $operatorGroup = null,
        public ?array $reason = null,
        public array $extra = [],
    ) {}
}
