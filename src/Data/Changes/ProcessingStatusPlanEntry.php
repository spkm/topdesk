<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ProcessingStatusPlanEntry record from TOPdesk's Change Management API.
 */
readonly class ProcessingStatusPlanEntry extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $processingStatus = null,
        public ?CarbonImmutable $plannedEndDate = null,
        public ?TransitionPerformer $performer = null,
        public ?AssigneeGroup $assigneeGroup = null,
        public array $extra = [],
    ) {}
}
