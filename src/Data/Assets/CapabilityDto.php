<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A CapabilityDto record from TOPdesk's Asset Management API.
 */
readonly class CapabilityDto extends Data
{
    protected const ALIASES = ['etag' => '@etag'];

    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $etag = null,
        public ?string $archiveReasonId = null,
        public ?bool $archived = null,
        public ?bool $inUse = null,
        public ?Inheritance $inheritance = null,
        public ?string $name = null,
        public ?string $unid = null,
        public array $extra = [],
    ) {}
}
