<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ChangeActivityEntry record from TOPdesk's Change Management API.
 */
readonly class ChangeActivityEntry extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?string $briefDescription = null,
        public ?ChangeActivityParent $change = null,
        public ?string $activityType = null,
        public ?AssigneeDetailsIncludingNames $assignee = null,
        public ?string $processingStatus = null,
        public ?NameIdPair $status = null,
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $startDate = null,
        public ?CarbonImmutable $plannedFinalDate = null,
        public ?CarbonImmutable $finalDate = null,
        public ?bool $archived = null,
        public ?CarbonImmutable $creationDate = null,
        public ?CarbonImmutable $lastModificationDate = null,
        public ?NameIdPair $template = null,
        public ?NameIdPair $archiveReason = null,
        public ?NameIdPair $category = null,
        public ?NameIdPair $subcategory = null,
        public ?string $externalNumber = null,
        public ?CarbonImmutable $rejectedDate = null,
        public ?NameIdPair $rejectionReason = null,
        public ?CarbonImmutable $skippedDate = null,
        public ?NameIdPair $skippedReason = null,
        public ?CarbonImmutable $approvedDate = null,
        public ?NameIdPair $creator = null,
        public ?NameIdPair $modifier = null,
        public ?NameIdPair $supplier = null,
        public ?string $plannedChangePhase = null,
        public ?OptionalFields $optionalFields1 = null,
        public ?OptionalFields $optionalFields2 = null,
        public ?float $currentPlanCosts = null,
        public ?float $remainingCosts = null,
        public ?float $costs = null,
        public ?float $originalPlanCosts = null,
        public ?float $realizedCosts = null,
        public ?int $currentPlanTimeSpent = null,
        public ?int $remainingTimeSpent = null,
        public ?int $originalPlanTimeSpent = null,
        public ?int $timeSpent = null,
        public array $extra = [],
    ) {}
}
