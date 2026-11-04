<?php

namespace spkm\Topdesk\Data\Reservations;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A Reserved Service record from TOPdesk's Reservations API.
 */
readonly class ReservedService extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $serviceId = null,
        public ?int $amount = null,
        public ?CarbonImmutable $deliveryTime = null,
        public ?string $deliveryLocationId = null,
        public ?string $operatorId = null,
        public ?string $supplierId = null,
        public ?float $totalCosts = null,
        public ?string $notes = null,
        public ?bool $closed = null,
        public ?CarbonImmutable $closedDate = null,
        public array $extra = [],
    ) {}
}
