<?php

namespace spkm\Topdesk\Data\Reservations;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A RescheduleReservationDto record from TOPdesk's Reservations API.
 */
readonly class RescheduleReservationDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $plannedEndDate = null,
        public array $extra = [],
    ) {}
}
