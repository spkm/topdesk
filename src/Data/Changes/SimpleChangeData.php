<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A SimpleChangeData record from TOPdesk's Change Management API.
 */
readonly class SimpleChangeData extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $startDate = null,
        public ?CarbonImmutable $plannedImplementationDate = null,
        public ?CarbonImmutable $implementationDate = null,
        public ?CarbonImmutable $closedDate = null,
        public ?AssigneeDetailsIncludingNames $assignee = null,
        public ?PossibleStatusValues $possibleStatusValues = null,
        public array $extra = [],
    ) {}
}
