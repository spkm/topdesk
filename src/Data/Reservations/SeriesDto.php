<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A SeriesDto record from TOPdesk's Reservations API.
 *
 * The recurrency series this reservation is a part of. The id can be used as filter parameter in the get list
 * endpoint.
 */
readonly class SeriesDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public array $extra = [],
    ) {}
}
