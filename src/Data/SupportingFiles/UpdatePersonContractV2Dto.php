<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An UpdatePersonContractV2Dto record from TOPdesk's Supporting Files API.
 */
readonly class UpdatePersonContractV2Dto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?UpdateTravelAllowanceDto $travelAllowance = null,
        public ?UpdateContractInformationDto $contractInformation = null,
        public ?UpdateCompanyCarDto $companyCar = null,
        public ?UpdateCompensationAndBenefitsDto $compensationAndBenefits = null,
        public array $extra = [],
    ) {}
}
