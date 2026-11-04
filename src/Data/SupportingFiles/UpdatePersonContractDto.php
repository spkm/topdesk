<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An UpdatePersonContractDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdatePersonContractDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?CarbonImmutable $hireDate = null,
        public ?CarbonImmutable $employmentTerminationDate = null,
        public ?CarbonImmutable $contractStartDate = null,
        public ?CarbonImmutable $contractExpiryDate = null,
        public ?CarbonImmutable $endProbationPeriod = null,
        public array $extra = [],
    ) {}
}
