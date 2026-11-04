<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A TimeRegistrationCreate record from TOPdesk's Change Management API.
 */
readonly class TimeRegistrationCreate extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?int $timeSpent = null,
        public ?string $note = null,
        public ?CarbonImmutable $entryDate = null,
        public ?string $operator = null,
        public ?string $operatorGroup = null,
        public ?string $reason = null,
        public array $extra = [],
    ) {}
}
