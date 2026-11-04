<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ChangePhaseForDetailsEndpoint record from TOPdesk's Change Management API.
 */
readonly class ChangePhaseForDetailsEndpoint extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?CarbonImmutable $plannedEndDate = null,
        public ?CarbonImmutable $endDate = null,
        public ?ChangePhaseAuthorizer $authorizer = null,
        public array $extra = [],
    ) {}
}
