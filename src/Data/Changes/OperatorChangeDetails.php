<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An OperatorChangeDetails record from TOPdesk's Change Management API.
 */
readonly class OperatorChangeDetails extends Data
{
    /**
     * @param  array<mixed>|null  $possibleActions
     * @param  array<string, mixed>|null  $canceled
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?string $briefDescription = null,
        public ?NameIdPair $branch = null,
        public ?string $templateId = null,
        public ?NameIdPair $type = null,
        public ?ChangeRequester $requester = null,
        public ?bool $archived = null,
        public ?string $changeType = null,
        public ?CarbonImmutable $requestDate = null,
        public ?CarbonImmutable $creationDate = null,
        public ?CarbonImmutable $lastModificationDate = null,
        public ?bool $emergencyChange = null,
        public ?string $processingStatus = null,
        public ?Costs $costs = null,
        public ?array $possibleActions = null,
        public ?TransitionPerformer $coordinator = null,
        public ?ChangePhasesForDetailsEndpoint $phases = null,
        public ?SimpleChangeData $simple = null,
        public ?array $canceled = null,
        public ?string $externalNumber = null,
        public ?ConfigurationObjectDetailed $object = null,
        public ?Id $asset = null,
        public ?NameIdPair $location = null,
        public ?string $requests = null,
        public ?string $progressTrail = null,
        public ?NameIdPair $impact = null,
        public ?NameIdPair $benefit = null,
        public ?NameIdPair $priority = null,
        public ?NameIdPair $category = null,
        public ?NameIdPair $subcategory = null,
        public ?NameIdPair $status = null,
        public ?OptionalFields $optionalFields1 = null,
        public ?OptionalFields $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
