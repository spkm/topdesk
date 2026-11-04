<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ProcessingStatusTransition record from TOPdesk's Change Management API.
 */
readonly class ProcessingStatusTransition extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $from = null,
        public ?string $to = null,
        public ?string $action = null,
        public ?CarbonImmutable $date = null,
        public ?NameIdPair $reason = null,
        public ?TransitionPerformer $performer = null,
        public array $extra = [],
    ) {}
}
