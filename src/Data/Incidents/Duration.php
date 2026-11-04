<?php

namespace spkm\Topdesk\Data\Incidents;

use spkm\Topdesk\Data\Data;

/**
 * A Duration record from TOPdesk's Incident Management API.
 */
readonly class Duration extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?float $basicPeriods = null,
        public ?string $timeSpanType = null,
        public ?bool $inFirstLine = null,
        public ?bool $inSecondLine = null,
        public array $extra = [],
    ) {}
}
