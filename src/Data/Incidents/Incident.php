<?php

namespace spkm\Topdesk\Data\Incidents;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An Incident record from TOPdesk's Incident Management API.
 */
readonly class Incident extends Data
{
    /**
     * @param  array<string, mixed>|null  $category
     * @param  array<string, mixed>|null  $subcategory
     * @param  array<string, mixed>|null  $asset
     * @param  array<string, mixed>|null  $location
     * @param  array<string, mixed>|null  $priority
     * @param  array<string, mixed>|null  $duration
     * @param  array<string, mixed>|null  $sla
     * @param  array<string, mixed>|null  $supplier
     * @param  array<string, mixed>|null  $processingStatus
     * @param  array<string, mixed>|null  $archivingReason
     * @param  array<string, mixed>|null  $majorCallObject
     * @param  array<string, mixed>|null  $mainIncident
     * @param  array<mixed>|null  $partialIncidents
     * @param  array<mixed>|null  $externalLinks
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $status = null,
        public ?string $number = null,
        public ?string $request = null,
        public ?string $requests = null,
        public ?string $action = null,
        public ?string $attachments = null,
        public ?Caller $caller = null,
        public ?Branch $callerBranch = null,
        public ?Searchlist $callerLocation = null,
        public ?Searchlist $branchExtraFieldA = null,
        public ?Searchlist $branchExtraFieldB = null,
        public ?string $briefDescription = null,
        public ?string $externalNumber = null,
        public ?array $category = null,
        public ?array $subcategory = null,
        public ?Searchlist $callType = null,
        public ?Searchlist $entryType = null,
        public ?ObjectRecord $object = null,
        public ?array $asset = null,
        public ?Branch $branch = null,
        public ?array $location = null,
        public ?Searchlist $impact = null,
        public ?Searchlist $urgency = null,
        public ?array $priority = null,
        public ?array $duration = null,
        public ?float $actualDuration = null,
        public ?CarbonImmutable $targetDate = null,
        public ?array $sla = null,
        public ?CarbonImmutable $responseDate = null,
        public ?bool $onHold = null,
        public ?CarbonImmutable $onHoldDate = null,
        public ?float $onHoldDuration = null,
        public ?string $feedbackMessage = null,
        public ?int $feedbackRating = null,
        public ?Operator $operator = null,
        public ?Searchlist $operatorGroup = null,
        public ?array $supplier = null,
        public ?array $processingStatus = null,
        public ?bool $completed = null,
        public ?CarbonImmutable $completedDate = null,
        public ?bool $closed = null,
        public ?CarbonImmutable $closedDate = null,
        public ?Searchlist $closureCode = null,
        public ?float $timeSpent = null,
        public ?float $timeSpentFirstLine = null,
        public ?float $timeSpentSecondLine = null,
        public ?float $timeSpentPartial = null,
        public ?float $timeSpentLinkedPartials = null,
        public ?float $timeSpentSecondLineAndPartials = null,
        public ?float $itemCosts = null,
        public ?float $objectCosts = null,
        public ?float $costs = null,
        public ?string $escalationStatus = null,
        public ?Searchlist $escalationReason = null,
        public ?Searchlist $escalationOperator = null,
        public ?CarbonImmutable $callDate = null,
        public ?Searchlist $creator = null,
        public ?CarbonImmutable $creationDate = null,
        public ?Searchlist $modifier = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?array $archivingReason = null,
        public ?bool $majorCall = null,
        public ?array $majorCallObject = null,
        public ?bool $publishToSsd = null,
        public ?bool $monitored = null,
        public ?bool $responded = null,
        public ?float $expectedTimeSpent = null,
        public ?array $mainIncident = null,
        public ?array $partialIncidents = null,
        public ?OptionalFields $optionalFields1 = null,
        public ?OptionalFields $optionalFields2 = null,
        public ?array $externalLinks = null,
        public ?bool $bookmarked = null,
        public array $extra = [],
    ) {}
}
