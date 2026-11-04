<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An ArchivePersonGroupResponse record from TOPdesk's Supporting Files API.
 */
readonly class ArchivePersonGroupResponse extends Data
{
    /**
     * @param  array<string, mixed>|null  $archivingReason
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?array $archivingReason = null,
        public ?bool $archived = null,
        public array $extra = [],
    ) {}
}
