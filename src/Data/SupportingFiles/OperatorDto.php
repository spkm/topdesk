<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An OperatorDto record from TOPdesk's Supporting Files API.
 */
readonly class OperatorDto extends Data
{
    protected const LISTS = ['accessRoles' => LinkDto::class];

    /**
     * @param  Collection<int, LinkDto>|null  $accessRoles
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $principalId = null,
        public ?string $status = null,
        public ?string $accountType = null,
        public ?bool $apiAccount = null,
        public ?bool $hasApplicationPasswords = null,
        public ?string $surName = null,
        public ?string $firstName = null,
        public ?string $dynamicName = null,
        public ?string $initials = null,
        public ?string $prefixes = null,
        public ?string $birthName = null,
        public ?string $title = null,
        public ?string $gender = null,
        public ?SearchlistDto $language = null,
        public ?BranchDto $branch = null,
        public ?LocationDto $location = null,
        public ?string $telephone = null,
        public ?string $mobileNumber = null,
        public ?string $faxNumber = null,
        public ?string $email = null,
        public ?string $exchangeAccount = null,
        public ?string $loginName = null,
        public ?bool $loginPermission = null,
        public ?SearchlistDto $linkedPerson = null,
        public ?string $jobTitle = null,
        public ?SearchlistDto $department = null,
        public ?SearchlistDto $budgetHolder = null,
        public ?string $employeeNumber = null,
        public ?float $hourlyRate = null,
        public ?string $networkLoginName = null,
        public ?string $mainframeLoginName = null,
        public ?bool $hasAttention = null,
        public ?SearchlistDto $attention = null,
        public ?string $comments = null,
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
        public ?CarbonImmutable $creationDate = null,
        public ?SearchlistDto $creator = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?SearchlistDto $modifier = null,
        public ?Collection $accessRoles = null,
        public ?OptionalFieldsDto $optionalFields1 = null,
        public ?OptionalFieldsDto $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
