<?php

namespace spkm\Topdesk\Data\Visitors;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An ExternalLinkDto record from TOPdesk's Visitor Registration API.
 */
readonly class ExternalLinkDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $type = null,
        public ?CarbonImmutable $date = null,
        public array $extra = [],
    ) {}
}
