<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A MinimalSimplePhase record from TOPdesk's Change Management API.
 */
readonly class MinimalSimplePhase extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?AssigneeDetails $authorizer = null,
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $plannedImplementationDate = null,
        public array $extra = [],
    ) {}
}
