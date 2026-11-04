<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An UpdatePersonV2Dto record from TOPdesk's Supporting Files API.
 *
 * To update the 'department' field, please use: 'department' object with 'id' field if "Drop-down list" is selected in
 * the Settings for the department field. 'department' object with 'name' field if "plain text field" is selected in
 * the Settings for the department field.
 */
readonly class UpdatePersonV2Dto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $surName = null,
        public ?string $firstName = null,
        public ?string $firstInitials = null,
        public ?string $prefixes = null,
        public ?string $birthName = null,
        public ?string $employeeNumber = null,
        public ?string $tasLoginName = null,
        public ?bool $hasSspAccess = null,
        public ?string $networkLoginName = null,
        public ?string $mainframeLoginName = null,
        public ?IdentifiableDto $budgetHolder = null,
        public ?IdentifiableDto $branch = null,
        public ?IdentifiableDto $location = null,
        public ?IdentifiableDto $department = null,
        public ?UpdateLanguageDto $language = null,
        public ?string $phoneNumber = null,
        public ?string $mobileNumber = null,
        public ?string $fax = null,
        public ?string $email = null,
        public ?string $title = null,
        public ?string $jobTitle = null,
        public ?bool $showBudgetHolder = null,
        public ?bool $showDepartment = null,
        public ?bool $showBranch = null,
        public ?bool $showObjectsOfBranch = null,
        public ?bool $showSubsidiaries = null,
        public ?bool $showObjectsOfSubsidiaries = null,
        public ?bool $showAllBranches = null,
        public ?bool $authorizeAll = null,
        public ?bool $authorizeDepartment = null,
        public ?bool $authorizeBudgetHolder = null,
        public ?bool $authorizeBranch = null,
        public ?bool $authorizeSubsidiaryBranches = null,
        public ?UpdateAttentionDto $attention = null,
        public ?bool $isCaller = null,
        public ?bool $isManager = null,
        public ?IdentifiableDto $manager = null,
        public ?IdentifiableDto $personExtraFieldA = null,
        public ?IdentifiableDto $personExtraFieldB = null,
        public ?ModifyOptionalFieldsDto $optionalFields1 = null,
        public ?ModifyOptionalFieldsDto $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
