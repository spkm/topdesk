<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A timeRegistration record from TOPdesk's Operations Management API.
 */
readonly class TimeRegistration extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?int $timeSpent = null,
        public ?string $note = null,
        public ?CarbonImmutable $entryDate = null,
        public ?IdOnly $reason = null,
        public ?IdOnly $operator = null,
        public ?IdOnly $operatorGroup = null,
        public array $extra = [],
    ) {}
}
