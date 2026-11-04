<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An UpdateContractInformationDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdateContractInformationDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?CarbonImmutable $hireDate = null,
        public ?CarbonImmutable $employmentTerminationDate = null,
        public ?CarbonImmutable $contractStartDate = null,
        public ?CarbonImmutable $contractExpiryDate = null,
        public ?CarbonImmutable $endOfProbationaryPeriod = null,
        public ?IdentifiableDto $contractType = null,
        public ?int $contractHours = null,
        public ?IdentifiableDto $salaryScale = null,
        public ?float $grossSalary = null,
        public ?int $holidayDays = null,
        public ?IdentifiableDto $collectiveLabourAgreement = null,
        public ?string $pensionRegistrationNumber = null,
        public ?IdentifiableDto $educationLevel = null,
        public array $extra = [],
    ) {}
}
