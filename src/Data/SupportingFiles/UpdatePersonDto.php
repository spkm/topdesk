<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An UpdatePersonDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdatePersonDto extends Data
{
    protected const HIDDEN = ['password'];

    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $surName = null,
        public ?string $firstName = null,
        public ?string $firstInitials = null,
        public ?string $prefixes = null,
        public ?string $birthName = null,
        public ?string $gender = null,
        public ?string $employeeNumber = null,
        public ?string $networkLoginName = null,
        public ?string $mainframeLoginName = null,
        public ?IdentifiableDto $branch = null,
        public ?IdentifiableDto $location = null,
        public ?IdentifiableDto $department = null,
        public ?IdentifiableDto $language = null,
        public ?string $departmentFree = null,
        public ?string $tasLoginName = null,
        public ?string $password = null,
        public ?string $phoneNumber = null,
        public ?string $mobileNumber = null,
        public ?string $fax = null,
        public ?string $email = null,
        public ?string $title = null,
        public ?string $jobTitle = null,
        public ?bool $showBudgetholder = null,
        public ?bool $showDepartment = null,
        public ?bool $showBranch = null,
        public ?bool $showSubsidiaries = null,
        public ?bool $showAllBranches = null,
        public ?bool $authorizeAll = null,
        public ?bool $authorizeDepartment = null,
        public ?bool $authorizeBudgetHolder = null,
        public ?bool $authorizeBranch = null,
        public ?bool $authorizeSubsidiaryBranches = null,
        public ?ModifyOptionalFieldsDto $optionalFields1 = null,
        public ?ModifyOptionalFieldsDto $optionalFields2 = null,
        public ?IdentifiableDto $budgetHolder = null,
        public ?IdentifiableDto $personExtraFieldA = null,
        public ?IdentifiableDto $personExtraFieldB = null,
        public ?IdentifiableDto $attention = null,
        public ?string $attentionComment = null,
        public ?bool $isManager = null,
        public ?IdentifiableDto $manager = null,
        public array $extra = [],
    ) {}
}
