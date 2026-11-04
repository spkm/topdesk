<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * A Branch record from TOPdesk's Incident Management API.
 */
readonly class Branch extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $clientReferenceNumber = null,
        public ?string $timeZone = null,
        public ?Searchlist $extraA = null,
        public ?Searchlist $extraB = null,
        public ?string $id = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
