<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An OperatorChangeEntry record from TOPdesk's Change Management API.
 */
readonly class OperatorChangeEntry extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?string $briefDescription = null,
        public ?string $changeType = null,
        public ?bool $archived = null,
        public ?CarbonImmutable $creationDate = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?NameIdPair $status = null,
        public ?MinimalSimpleChangeData $simple = null,
        public ?NameIdPair $archiveReason = null,
        public ?NameIdPair $branch = null,
        public ?MinimalIncident $incident = null,
        public ?NameIdPair $location = null,
        public ?NameIdPair $milestone = null,
        public ?CarbonImmutable $submitDate = null,
        public ?NameIdPair $supplier = null,
        public ?NameIdPair $creator = null,
        public ?NameIdPair $modifier = null,
        public ?NameIdPair $version = null,
        public ?bool $withEvaluation = null,
        public ?NameIdPair $template = null,
        public ?NameIdPair $type = null,
        public ?ListRequester $requester = null,
        public ?ConfigurationObject $object = null,
        public ?CarbonImmutable $requestDate = null,
        public ?bool $urgent = null,
        public ?string $processingStatus = null,
        public ?NameIdPair $coordinator = null,
        public ?string $externalNumber = null,
        public ?NameIdPair $impact = null,
        public ?NameIdPair $benefit = null,
        public ?NameIdPair $priority = null,
        public ?NameIdPair $category = null,
        public ?NameIdPair $subcategory = null,
        public ?Canceled $canceled = null,
        public ?ChangePhasesForListEndpoint $phases = null,
        public ?OptionalFields $optionalFields1 = null,
        public ?OptionalFields $optionalFields2 = null,
        public ?Id $asset = null,
        public ?float $currentPlanCosts = null,
        public ?float $estimateCosts = null,
        public ?float $simpleCosts = null,
        public ?float $originalPlanCosts = null,
        public ?float $realizedCostsOnActivities = null,
        public ?float $remainingCostsOnActivities = null,
        public ?int $currentPlanTimeSpent = null,
        public ?int $estimateTimeSpent = null,
        public ?int $originalPlanTimeSpent = null,
        public ?int $realizedTimeSpentOnActivities = null,
        public ?int $remainingTimeSpentOnActivities = null,
        public ?int $simpleTimeSpent = null,
        public array $extra = [],
    ) {}
}
