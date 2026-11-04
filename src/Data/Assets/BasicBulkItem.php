<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A BasicBulkItem record from TOPdesk's Asset Management API.
 *
 * The bulk item linked to the stock.
 */
readonly class BasicBulkItem extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?BasicBulkItemTemplate $template = null,
        public array $extra = [],
    ) {}
}
