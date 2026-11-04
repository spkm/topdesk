<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A PersonDto record from TOPdesk's Supporting Files API.
 */
readonly class PersonDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $status = null,
        public ?string $surName = null,
        public ?string $firstName = null,
        public ?string $dynamicName = null,
        public ?string $firstInitials = null,
        public ?string $prefixes = null,
        public ?string $birthName = null,
        public ?string $title = null,
        public ?string $gender = null,
        public ?SearchlistDto $language = null,
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
        public ?string $clientReferenceNumber = null,
        public ?string $city = null,
        public ?string $tasLoginName = null,
        public ?bool $showBranch = null,
        public ?bool $showBudgetholder = null,
        public ?bool $showDepartment = null,
        public ?bool $showSubsidiaries = null,
        public ?bool $showAllBranches = null,
        public ?bool $authorizeAll = null,
        public ?bool $authorizeDepartment = null,
        public ?bool $authorizeBudgetHolder = null,
        public ?bool $authorizeBranch = null,
        public ?bool $authorizeSubsidiaryBranches = null,
        public ?bool $isManager = null,
        public ?SearchlistDto $manager = null,
        public ?bool $hasAttention = null,
        public ?SearchlistDto $attention = null,
        public ?string $attentionComment = null,
        public ?SearchlistDto $creator = null,
        public ?CarbonImmutable $creationDate = null,
        public ?SearchlistDto $modifier = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?OptionalFieldsDto $optionalFields1 = null,
        public ?OptionalFieldsDto $optionalFields2 = null,
        public ?SearchlistDto $personExtraFieldA = null,
        public ?SearchlistDto $personExtraFieldB = null,
        public ?string $departmentFree = null,
        public ?BranchDto $branch = null,
        public ?LocationDto $location = null,
        public array $extra = [],
    ) {}
}
