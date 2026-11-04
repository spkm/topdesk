<?php

namespace spkm\Topdesk\Data\Services;

use spkm\Topdesk\Data\Data;

/**
 * A ServiceListEntryDto record from TOPdesk's Services API.
 */
readonly class ServiceListEntryDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $briefDescription = null,
        public ?bool $availableForIncidents = null,
        public ?bool $availableForReservations = null,
        public ?bool $published = null,
        public array $extra = [],
    ) {}
}
