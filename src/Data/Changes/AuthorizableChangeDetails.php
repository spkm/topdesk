<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An AuthorizableChangeDetails record from TOPdesk's Change Management API.
 */
readonly class AuthorizableChangeDetails extends Data
{
    protected const LISTS = ['processingStatusTransitions' => ProcessingStatusTransition::class, 'processingStatusPlan' => ProcessingStatusPlanEntry::class];

    /**
     * @param  Collection<int, ProcessingStatusTransition>|null  $processingStatusTransitions
     * @param  Collection<int, ProcessingStatusPlanEntry>|null  $processingStatusPlan
     * @param  array<mixed>|null  $possibleActions
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?CarbonImmutable $creationDate = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?CarbonImmutable $requestDate = null,
        public ?NameIdPair $requester = null,
        public ?string $request = null,
        public ?string $briefDescription = null,
        public ?string $changeType = null,
        public ?string $processingStatus = null,
        public ?Collection $processingStatusTransitions = null,
        public ?Collection $processingStatusPlan = null,
        public ?string $requests = null,
        public ?string $progressTrail = null,
        public ?string $orderedItems = null,
        public ?NameIdPair $type = null,
        public ?NameIdPair $category = null,
        public ?NameIdPair $subcategory = null,
        public ?ConfigurationObject $object = null,
        public ?Location $location = null,
        public ?NameIdPair $impact = null,
        public ?NameIdPair $benefit = null,
        public ?NameIdPair $priority = null,
        public ?NameIdPair $version = null,
        public ?NameIdPair $milestone = null,
        public ?NameIdPair $status = null,
        public ?bool $emergency = null,
        public ?array $possibleActions = null,
        public array $extra = [],
    ) {}
}
