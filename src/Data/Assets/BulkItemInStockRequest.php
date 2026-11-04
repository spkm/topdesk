<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A BulkItemInStockRequest record from TOPdesk's Asset Management API.
 *
 * Quantity and identifiers of the to be linked stock and bulk item.
 */
readonly class BulkItemInStockRequest extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $bulkItemId = null,
        public ?int $quantity = null,
        public ?string $stockId = null,
        public array $extra = [],
    ) {}
}
