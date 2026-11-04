<?php

namespace spkm\Topdesk\Data\Changes;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ChangeCancelOptionsDto record from TOPdesk's Change Management API.
 */
readonly class ChangeCancelOptionsDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $canceledById = null,
        public ?CarbonImmutable $cancelDate = null,
        public ?string $cancelReason = null,
        public ?string $action = null,
        public array $extra = [],
    ) {}
}
