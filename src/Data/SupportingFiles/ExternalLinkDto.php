<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An ExternalLinkDto record from TOPdesk's Supporting Files API.
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
