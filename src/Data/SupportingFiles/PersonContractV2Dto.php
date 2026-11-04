<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A PersonContractV2Dto record from TOPdesk's Supporting Files API.
 */
readonly class PersonContractV2Dto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $personId = null,
        public ?TravelAllowanceDto $travelAllowance = null,
        public ?ContractInformationDto $contractInformation = null,
        public ?CompanyCarDto $companyCar = null,
        public ?CompensationAndBenefitsDto $compensationAndBenefits = null,
        public array $extra = [],
    ) {}
}
