<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An UpdateCompanyCarDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdateCompanyCarDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $hasCompanyCar = null,
        public ?float $companyCarBudget = null,
        public array $extra = [],
    ) {}
}
