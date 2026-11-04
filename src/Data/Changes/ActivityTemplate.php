<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * An ActivityTemplate record from TOPdesk's Change Management API.
 */
readonly class ActivityTemplate extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?string $briefDescription = null,
        public ?string $activityType = null,
        public ?string $plannedForPhase = null,
        public array $extra = [],
    ) {}
}
