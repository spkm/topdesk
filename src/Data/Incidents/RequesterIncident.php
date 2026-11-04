<?php

namespace spkm\Topdesk\Data\Incidents;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A RequesterIncident record from TOPdesk's Incident Management API.
 */
readonly class RequesterIncident extends Data
{
    /**
     * @param  array<string, mixed>|null  $category
     * @param  array<string, mixed>|null  $subcategory
     * @param  array<string, mixed>|null  $asset
     * @param  array<string, mixed>|null  $location
     * @param  array<string, mixed>|null  $priority
     * @param  array<string, mixed>|null  $duration
     * @param  array<string, mixed>|null  $processingStatus
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
        public ?RequesterCaller $caller = null,
        public ?RequesterBranch $callerBranch = null,
        public ?Searchlist $callerLocation = null,
        public ?string $briefDescription = null,
        public ?array $category = null,
        public ?array $subcategory = null,
        public ?Searchlist $callType = null,
        public ?RequesterObject $object = null,
        public ?array $asset = null,
        public ?RequesterBranch $branch = null,
        public ?array $location = null,
        public ?Searchlist $impact = null,
        public ?Searchlist $urgency = null,
        public ?array $priority = null,
        public ?array $duration = null,
        public ?CarbonImmutable $targetDate = null,
        public ?bool $onHold = null,
        public ?string $feedbackMessage = null,
        public ?int $feedbackRating = null,
        public ?Operator $operator = null,
        public ?Searchlist $operatorGroup = null,
        public ?array $processingStatus = null,
        public ?bool $completed = null,
        public ?CarbonImmutable $completedDate = null,
        public ?bool $closed = null,
        public ?CarbonImmutable $closedDate = null,
        public ?Searchlist $closureCode = null,
        public ?float $timeSpent = null,
        public ?float $costs = null,
        public ?CarbonImmutable $callDate = null,
        public ?float $expectedTimeSpent = null,
        public array $extra = [],
    ) {}
}
