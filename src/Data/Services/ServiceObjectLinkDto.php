<?php

namespace spkm\Topdesk\Data\Services;

use spkm\Topdesk\Data\Data;

/**
 * A ServiceObjectLinkDto record from TOPdesk's Services API.
 */
readonly class ServiceObjectLinkDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $standard = null,
        public array $extra = [],
    ) {}
}
