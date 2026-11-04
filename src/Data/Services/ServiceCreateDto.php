<?php

namespace spkm\Topdesk\Data\Services;

use spkm\Topdesk\Data\Data;

/**
 * A ServiceCreateDto record from TOPdesk's Services API.
 */
readonly class ServiceCreateDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public ?string $defaultFirstLineOperator = null,
        public ?string $defaultSecondLineOperator = null,
        public ?string $defaultReservationsOperator = null,
        public ?string $manager = null,
        public array $extra = [],
    ) {}
}
