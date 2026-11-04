<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A CompensationAndBenefitsDto record from TOPdesk's Supporting Files API.
 */
readonly class CompensationAndBenefitsDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $expenses = null,
        public ?string $representationAllowance = null,
        public ?string $hotelAllowance = null,
        public ?string $otherBenefits = null,
        public array $extra = [],
    ) {}
}
