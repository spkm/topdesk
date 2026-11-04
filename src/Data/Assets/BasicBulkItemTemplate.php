<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A BasicBulkItemTemplate record from TOPdesk's Asset Management API.
 *
 * The template of the bulk item.
 */
readonly class BasicBulkItemTemplate extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $icon = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
