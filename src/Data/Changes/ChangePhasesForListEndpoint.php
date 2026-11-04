<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A ChangePhasesForListEndpoint record from TOPdesk's Change Management API.
 */
readonly class ChangePhasesForListEndpoint extends Data
{
    /**
     * @param  array<string, mixed>|null  $prfc
     * @param  array<string, mixed>|null  $rfc
     * @param  array<string, mixed>|null  $progress
     * @param  array<string, mixed>|null  $evaluation
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $prfc = null,
        public ?array $rfc = null,
        public ?array $progress = null,
        public ?array $evaluation = null,
        public array $extra = [],
    ) {}
}
