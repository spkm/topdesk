<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A TimeRegistrationEntry record from TOPdesk's Change Management API.
 */
readonly class TimeRegistrationEntry extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?int $timeSpent = null,
        public ?string $note = null,
        public ?CarbonImmutable $entryDate = null,
        public ?NameIdPair $operator = null,
        public ?NameIdPair $operatorGroup = null,
        public ?NameIdPair $reason = null,
        public array $extra = [],
    ) {}
}
