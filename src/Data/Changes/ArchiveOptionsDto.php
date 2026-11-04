<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * An ArchiveOptionsDto record from TOPdesk's Change Management API.
 */
readonly class ArchiveOptionsDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $archiveReason = null,
        public array $extra = [],
    ) {}
}
