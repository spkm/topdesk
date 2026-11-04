<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A ChangePhasesForDetailsEndpoint record from TOPdesk's Change Management API.
 */
readonly class ChangePhasesForDetailsEndpoint extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?ChangePhaseForDetailsEndpoint $prfc = null,
        public ?ChangePhaseForDetailsEndpoint $rfc = null,
        public ?ChangePhaseForDetailsEndpoint $progress = null,
        public ?ChangePhaseForDetailsEndpoint $evaluation = null,
        public array $extra = [],
    ) {}
}
