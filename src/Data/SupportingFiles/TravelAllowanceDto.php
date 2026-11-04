<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A TravelAllowanceDto record from TOPdesk's Supporting Files API.
 */
readonly class TravelAllowanceDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $hasTravelAllowance = null,
        public ?float $travelAllowanceAmount = null,
        public ?int $workDistance = null,
        public ?SearchlistDto $typeOfAllowance = null,
        public array $extra = [],
    ) {}
}
