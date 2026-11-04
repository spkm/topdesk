<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ChangeActivityDetails record from TOPdesk's Change Management API.
 */
readonly class ChangeActivityDetails extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?string $briefDescription = null,
        public ?string $plannedChangePhase = null,
        public ?NameIdPair $status = null,
        public ?string $activityType = null,
        public ?string $processingStatus = null,
        public ?bool $archived = null,
        public ?CarbonImmutable $creationDate = null,
        public ?CarbonImmutable $lastModificationDate = null,
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $startDate = null,
        public ?CarbonImmutable $resolvedDate = null,
        public ?CarbonImmutable $skippedDate = null,
        public ?CarbonImmutable $approvedDate = null,
        public ?CarbonImmutable $rejectedDate = null,
        public ?CarbonImmutable $plannedFinalDate = null,
        public ?CarbonImmutable $finalDate = null,
        public ?NameIdPair $rejectionReason = null,
        public ?NameIdPair $category = null,
        public ?NameIdPair $subcategory = null,
        public ?AssigneeDetailsIncludingNames $assignee = null,
        public ?ChangeActivityParent $change = null,
        public ?string $requests = null,
        public ?string $progressTrail = null,
        public ?OptionalFields $optionalFields1 = null,
        public ?OptionalFields $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
