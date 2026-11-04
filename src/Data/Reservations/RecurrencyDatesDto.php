<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A RecurrencyDatesDto record from TOPdesk's Reservations API.
 */
readonly class RecurrencyDatesDto extends Data
{
    /**
     * @param  array<mixed>|null  $dates
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $dates = null,
        public array $extra = [],
    ) {}
}
