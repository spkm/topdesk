<?php

namespace spkm\Topdesk\Data\Incidents;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A RequesterImage record from TOPdesk's Incident Management API.
 */
readonly class RequesterImage extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $filename = null,
        public ?string $downloadUrl = null,
        public ?string $originalFileName = null,
        public ?float $fileSize = null,
        public ?CarbonImmutable $entryDate = null,
        public array $extra = [],
    ) {}
}
