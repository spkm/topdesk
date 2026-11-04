<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ChangeCalendarEntry record from TOPdesk's Change Management API.
 */
readonly class ChangeCalendarEntry extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?string $briefDescription = null,
        public ?string $cardType = null,
        public ?CarbonImmutable $start = null,
        public ?CarbonImmutable $end = null,
        public ?string $currentState = null,
        public array $extra = [],
    ) {}
}
