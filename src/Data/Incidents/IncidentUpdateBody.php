<?php

namespace spkm\Topdesk\Data\Incidents;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An IncidentUpdateBody record from TOPdesk's Incident Management API.
 */
readonly class IncidentUpdateBody extends Data
{
    /**
     * @param  array<string, mixed>|null  $callerLookup
     * @param  array<string, mixed>|null  $branchExtraFieldA
     * @param  array<string, mixed>|null  $branchExtraFieldB
     * @param  array<string, mixed>|null  $entryType
     * @param  array<string, mixed>|null  $callType
     * @param  array<string, mixed>|null  $category
     * @param  array<string, mixed>|null  $subcategory
     * @param  array<string, mixed>|null  $object
     * @param  array<string, mixed>|null  $location
     * @param  array<string, mixed>|null  $branch
     * @param  array<string, mixed>|null  $impact
     * @param  array<string, mixed>|null  $urgency
     * @param  array<string, mixed>|null  $priority
     * @param  array<string, mixed>|null  $duration
     * @param  array<string, mixed>|null  $sla
     * @param  array<string, mixed>|null  $operator
     * @param  array<string, mixed>|null  $operatorGroup
     * @param  array<string, mixed>|null  $supplier
     * @param  array<string, mixed>|null  $processingStatus
     * @param  array<string, mixed>|null  $closureCode
     * @param  array<string, mixed>|null  $majorCallObject
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?CallerCreate $caller = null,
        public ?array $callerLookup = null,
        public ?array $branchExtraFieldA = null,
        public ?array $branchExtraFieldB = null,
        public ?string $briefDescription = null,
        public ?string $request = null,
        public ?string $action = null,
        public ?bool $actionInvisibleForCaller = null,
        public ?array $entryType = null,
        public ?array $callType = null,
        public ?CarbonImmutable $callDate = null,
        public ?array $category = null,
        public ?array $subcategory = null,
        public ?string $externalNumber = null,
        public ?array $object = null,
        public ?array $location = null,
        public ?array $branch = null,
        public ?array $impact = null,
        public ?array $urgency = null,
        public ?array $priority = null,
        public ?array $duration = null,
        public ?CarbonImmutable $targetDate = null,
        public ?array $sla = null,
        public ?bool $onHold = null,
        public ?array $operator = null,
        public ?array $operatorGroup = null,
        public ?array $supplier = null,
        public ?array $processingStatus = null,
        public ?bool $responded = null,
        public ?CarbonImmutable $responseDate = null,
        public ?bool $completed = null,
        public ?CarbonImmutable $completedDate = null,
        public ?bool $closed = null,
        public ?CarbonImmutable $closedDate = null,
        public ?array $closureCode = null,
        public ?float $costs = null,
        public ?float $feedbackRating = null,
        public ?string $feedbackMessage = null,
        public ?bool $majorCall = null,
        public ?array $majorCallObject = null,
        public ?bool $publishToSsd = null,
        public ?OptionalFields $optionalFields1 = null,
        public ?OptionalFields $optionalFields2 = null,
        public ?ExternalLink $externalLink = null,
        public array $extra = [],
    ) {}
}
