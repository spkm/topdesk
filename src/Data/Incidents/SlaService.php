<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * A SlaService record from TOPdesk's Incident Management API.
 */
readonly class SlaService extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $contractId = null,
        public ?string $contractName = null,
        public ?string $contractSequenceNumber = null,
        public ?string $serviceId = null,
        public ?string $serviceName = null,
        public ?string $serviceLevelId = null,
        public ?string $serviceLevelName = null,
        public array $extra = [],
    ) {}
}
