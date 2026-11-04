<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A PersonV2Dto record from TOPdesk's Supporting Files API.
 *
 * Represents a Person card. The structure of the 'Department' field depends on its settings: With "Drop-down list," it
 * includes both 'name' and 'id'. With "Plain text field," it includes only 'name'.
 */
readonly class PersonV2Dto extends Data
{
    /**
     * @param  array<string, mixed>|null  $language
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $principalId = null,
        public ?string $firstName = null,
        public ?string $surName = null,
        public ?string $dynamicName = null,
        public ?bool $archived = null,
        public ?SearchlistDto $modifier = null,
        public ?SearchlistDto $creator = null,
        public ?CarbonImmutable $creationDate = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?string $firstInitials = null,
        public ?string $prefixes = null,
        public ?string $birthName = null,
        public ?string $title = null,
        public ?array $language = null,
        public ?string $phoneNumber = null,
        public ?string $mobileNumber = null,
        public ?string $fax = null,
        public ?string $email = null,
        public ?string $jobTitle = null,
        public ?SearchlistDto $department = null,
        public ?SearchlistDto $budgetHolder = null,
        public ?string $employeeNumber = null,
        public ?string $networkLoginName = null,
        public ?string $mainframeLoginName = null,
        public ?string $city = null,
        public ?string $tasLoginName = null,
        public ?bool $hasSspAccess = null,
        public ?bool $showAllBranches = null,
        public ?bool $showBranch = null,
        public ?bool $showBudgetholder = null,
        public ?bool $showDepartment = null,
        public ?bool $showSubsidiaries = null,
        public ?bool $showObjectsOfBranch = null,
        public ?bool $showObjectsOfSubsidiaries = null,
        public ?bool $authorizeAll = null,
        public ?bool $authorizeBranch = null,
        public ?bool $authorizeBudgetHolder = null,
        public ?bool $authorizeDepartment = null,
        public ?bool $authorizeSubsidiaryBranches = null,
        public ?bool $isCaller = null,
        public ?bool $isManager = null,
        public ?SearchlistDto $manager = null,
        public ?bool $hasAttention = null,
        public ?AttentionV2Dto $attention = null,
        public ?BranchV2Dto $branch = null,
        public ?SearchlistDto $location = null,
        public ?SearchlistDto $personExtraFieldA = null,
        public ?SearchlistDto $personExtraFieldB = null,
        public ?OptionalFieldsDto $optionalFields1 = null,
        public ?OptionalFieldsDto $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
