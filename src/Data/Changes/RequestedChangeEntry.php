<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A RequestedChangeEntry record from TOPdesk's Change Management API.
 */
readonly class RequestedChangeEntry extends Data
{
    protected const LISTS = ['processingStatusTransitions' => ProcessingStatusTransition::class];

    /**
     * @param  Collection<int, ProcessingStatusTransition>|null  $processingStatusTransitions
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
        public array $extra = [],
    ) {}
}
