<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An UnlinkResponse record from TOPdesk's Asset Management API.
 */
readonly class UnlinkResponse extends Data
{
    /**
     * @param  array<mixed>|null  $successful
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $successful = null,
        public ?string $summary = null,
        public array $extra = [],
    ) {}
}
