<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An UpdateOperatorGroupDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdateOperatorGroupDto extends Data
{
    protected const LISTS = ['accessRoles' => LinkDto::class];

    /**
     * @param  Collection<int, LinkDto>|null  $accessRoles
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $accessRoles = null,
        public ?bool $accountManager = null,
        public ?IdentifiableDto $attention = null,
        public ?IdentifiableDto $branch = null,
        public ?IdentifiableDto $budgetHolder = null,
        public ?bool $changeActivitiesOperator = null,
        public ?bool $changeCoordinator = null,
        public ?string $comments = null,
        public ?OperatorGroupContactDto $contact = null,
        public ?bool $contractManager = null,
        public ?bool $extensiveChangeOperator = null,
        public ?bool $externalHelpDeskParty = null,
        public ?bool $firstLineCallOperator = null,
        public ?string $groupName = null,
        public ?float $hourlyRate = null,
        public ?bool $installer = null,
        public ?bool $knowledgeBaseManager = null,
        public ?IdentifiableDto $location = null,
        public ?bool $operationsManager = null,
        public ?bool $operationsOperator = null,
        public ?ModifyOptionalFieldsWithNameLookUpDto $optionalFields1 = null,
        public ?ModifyOptionalFieldsWithNameLookUpDto $optionalFields2 = null,
        public ?bool $planningActivityManager = null,
        public ?bool $problemManager = null,
        public ?bool $problemOperator = null,
        public ?bool $projectActivitiesOperator = null,
        public ?bool $projectCoordinator = null,
        public ?bool $requestForChangeOperator = null,
        public ?bool $reservationsOperator = null,
        public ?bool $scenarioManager = null,
        public ?bool $secondLineCallOperator = null,
        public ?bool $serviceOperator = null,
        public ?bool $simpleChangeOperator = null,
        public ?bool $stockManager = null,
        public ?bool $visibleOnPlanboard = null,
        public array $extra = [],
    ) {}
}
