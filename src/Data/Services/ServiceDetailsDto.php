<?php

namespace spkm\Topdesk\Data\Services;

use spkm\Topdesk\Data\Data;

/**
 * A ServiceDetailsDto record from TOPdesk's Services API.
 */
readonly class ServiceDetailsDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?bool $archived = null,
        public ?string $type = null,
        public ?string $defaultFirstLineOperator = null,
        public ?string $defaultSecondLineOperator = null,
        public ?string $defaultReservationsOperator = null,
        public ?string $manager = null,
        public ?SearchlistDto $serviceType = null,
        public ?bool $availableForIncidents = null,
        public ?bool $availableForReservations = null,
        public array $extra = [],
    ) {}
}
