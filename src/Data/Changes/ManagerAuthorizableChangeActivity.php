<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ManagerAuthorizableChangeActivity record from TOPdesk's Change Management API.
 */
readonly class ManagerAuthorizableChangeActivity extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $number = null,
        public ?string $briefDescription = null,
        public ?string $requests = null,
        public ?string $progressTrail = null,
        public ?string $managerAction = null,
        public ?CarbonImmutable $plannedAuthorizationDate = null,
        public ?CarbonImmutable $creationDate = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?CarbonImmutable $authorizationDate = null,
        public ?NameIdPair $category = null,
        public ?NameIdPair $subcategory = null,
        public ?TransitionPerformer $authorizer = null,
        public ?NameIdPair $rejectionReason = null,
        public ?ManagerAuthorizableChangeActivityParent $change = null,
        public ?NameIdPair $status = null,
        public array $extra = [],
    ) {}
}
