<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A MinimalOperatorActivity record from TOPdesk's Change Management API.
 */
readonly class MinimalOperatorActivity extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $activityTemplate = null,
        public ?string $changeId = null,
        public ?string $briefDescription = null,
        public ?string $activityType = null,
        public ?string $changePhase = null,
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $plannedFinalDate = null,
        public ?AssigneeDetails $assignee = null,
        public ?string $status = null,
        public ?string $category = null,
        public ?string $subcategory = null,
        public ?string $request = null,
        public ?string $action = null,
        public ?bool $actionInvisibleForCaller = null,
        public ?OptionalFieldsForWriting $optionalFields1 = null,
        public ?OptionalFieldsForWriting $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
