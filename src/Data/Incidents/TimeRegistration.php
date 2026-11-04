<?php

namespace spkm\Topdesk\Data\Incidents;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A TimeRegistration record from TOPdesk's Incident Management API.
 */
readonly class TimeRegistration extends Data
{
    /**
     * @param  array<string, mixed>|null  $status
     * @param  array<string, mixed>|null  $parent
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?int $timeSpent = null,
        public ?string $notes = null,
        public ?array $status = null,
        public ?CarbonImmutable $entryDate = null,
        public ?CarbonImmutable $creationDate = null,
        public ?Searchlist $operator = null,
        public ?Searchlist $operatorGroup = null,
        public ?Searchlist $reason = null,
        public ?array $parent = null,
        public ?Searchlist $creator = null,
        public ?Searchlist $modifier = null,
        public array $extra = [],
    ) {}
}
