<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A booleanAndDateTime record from TOPdesk's Operations Management API.
 */
readonly class BooleanAndDateTime extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $value = null,
        public ?CarbonImmutable $dateTime = null,
        public array $extra = [],
    ) {}
}
