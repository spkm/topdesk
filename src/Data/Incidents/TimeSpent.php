<?php

namespace spkm\Topdesk\Data\Incidents;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A TimeSpent record from TOPdesk's Incident Management API.
 */
readonly class TimeSpent extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?int $timeSpent = null,
        public ?string $notes = null,
        public ?float $status = null,
        public ?CarbonImmutable $entryDate = null,
        public ?CarbonImmutable $creationDate = null,
        public ?Searchlist $operator = null,
        public ?Searchlist $operatorGroup = null,
        public ?Searchlist $reason = null,
        public array $extra = [],
    ) {}
}
