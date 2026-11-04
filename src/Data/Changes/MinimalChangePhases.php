<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A MinimalChangePhases record from TOPdesk's Change Management API.
 */
readonly class MinimalChangePhases extends Data
{
    /**
     * @param  array<string, mixed>|null  $rfc
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?MinimalChangePhase $prfc = null,
        public ?array $rfc = null,
        public ?MinimalChangePhase $progress = null,
        public ?MinimalChangePhase $evaluation = null,
        public array $extra = [],
    ) {}
}
