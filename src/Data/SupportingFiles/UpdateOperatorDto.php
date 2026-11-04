<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An UpdateOperatorDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdateOperatorDto extends Data
{
    protected const LISTS = ['accessRoles' => LinkDto::class];

    protected const HIDDEN = ['password'];

    /**
     * @param  Collection<int, LinkDto>|null  $accessRoles
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $surName = null,
        public ?string $firstName = null,
        public ?string $firstInitials = null,
        public ?string $prefixes = null,
        public ?string $birthName = null,
        public ?string $title = null,
        public ?string $gender = null,
        public ?IdentifiableDto $language = null,
        public ?string $telephone = null,
        public ?string $mobileNumber = null,
        public ?string $faxNumber = null,
        public ?string $email = null,
        public ?string $exchangeAccount = null,
        public ?string $jobTitle = null,
        public ?IdentifiableDto $department = null,
        public ?IdentifiableDto $budgetHolder = null,
        public ?string $employeeNumber = null,
        public ?float $hourlyRate = null,
        public ?string $networkLoginName = null,
        public ?string $mainframeLoginName = null,
        public ?IdentifiableDto $branch = null,
        public ?IdentifiableDto $location = null,
        public ?string $loginName = null,
        public ?bool $loginPermission = null,
        public ?string $password = null,
        public ?bool $installer = null,
        public ?bool $firstLineCallOperator = null,
        public ?bool $secondLineCallOperator = null,
        public ?bool $problemManager = null,
        public ?bool $problemOperator = null,
        public ?bool $changeCoordinator = null,
        public ?bool $changeActivitiesOperator = null,
        public ?bool $requestForChangeOperator = null,
        public ?bool $extensiveChangeOperator = null,
        public ?bool $simpleChangeOperator = null,
        public ?bool $scenarioManager = null,
        public ?bool $planningActivityManager = null,
        public ?bool $projectCoordinator = null,
        public ?bool $projectActiviesOperator = null,
        public ?bool $stockManager = null,
        public ?bool $reservationsOperator = null,
        public ?bool $serviceOperator = null,
        public ?bool $externalHelpDeskParty = null,
        public ?bool $contractManager = null,
        public ?bool $operationsOperator = null,
        public ?bool $operationsManager = null,
        public ?bool $knowledgeBaseManager = null,
        public ?bool $accountManager = null,
        public ?IdentifiableDto $attention = null,
        public ?string $comments = null,
        public ?ModifyOptionalFieldsWithNameLookUpDto $optionalFields1 = null,
        public ?ModifyOptionalFieldsWithNameLookUpDto $optionalFields2 = null,
        public ?Collection $accessRoles = null,
        public array $extra = [],
    ) {}
}
