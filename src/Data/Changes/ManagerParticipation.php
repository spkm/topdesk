<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ManagerParticipation record from TOPdesk's Change Management API.
 */
readonly class ManagerParticipation extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $type = null,
        public ?CarbonImmutable $date = null,
        public ?NameIdPair $reason = null,
        public ?string $participationType = null,
        public ?TransitionPerformer $performer = null,
        public ?AssigneeGroup $group = null,
        public array $extra = [],
    ) {}
}
