<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ManagerAuthorizableChangeActivityParent record from TOPdesk's Change Management API.
 */
readonly class ManagerAuthorizableChangeActivityParent extends Data
{
    protected const LISTS = ['processingStatusTransitions' => ProcessingStatusTransition::class];

    /**
     * @param  Collection<int, ProcessingStatusTransition>|null  $processingStatusTransitions
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?NameIdPair $requester = null,
        public ?string $request = null,
        public ?string $briefDescription = null,
        public ?string $changeType = null,
        public ?string $processingStatus = null,
        public ?Collection $processingStatusTransitions = null,
        public ?string $requests = null,
        public ?string $progressTrail = null,
        public ?NameIdPair $type = null,
        public ?ConfigurationObject $object = null,
        public ?Location $location = null,
        public ?NameIdPair $impact = null,
        public ?NameIdPair $benefit = null,
        public ?NameIdPair $priority = null,
        public ?NameIdPair $version = null,
        public ?NameIdPair $milestone = null,
        public ?bool $emergency = null,
        public ?ListOfOrderedItems $orderedItems = null,
        public array $extra = [],
    ) {}
}
