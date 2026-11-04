<?php

namespace spkm\Topdesk\Data\Visitors;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A VisitDto record from TOPdesk's Visitor Registration API.
 */
readonly class VisitDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $arrivalStatus = null,
        public ?CarbonImmutable $expectedArrival = null,
        public ?CarbonImmutable $expectedDeparture = null,
        public ?CarbonImmutable $actualArrival = null,
        public ?CarbonImmutable $actualDeparture = null,
        public ?CarbonImmutable $cancellationDate = null,
        public ?string $reason = null,
        public array $extra = [],
    ) {}
}
