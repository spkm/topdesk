<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A CalendarDetails record from TOPdesk's Change Management API.
 *
 * Detailed information about the change given in the change calendar.
 */
readonly class CalendarDetails extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $number = null,
        public ?string $briefDescription = null,
        public ?NameIdPair $status = null,
        public ?string $currentState = null,
        public ?CarbonImmutable $startDate = null,
        public ?CarbonImmutable $endDate = null,
        public ?string $request = null,
        public ?string $requests = null,
        public ?string $progressTrail = null,
        public ?NameIdPair $category = null,
        public ?NameIdPair $subCategory = null,
        public array $extra = [],
    ) {}
}
