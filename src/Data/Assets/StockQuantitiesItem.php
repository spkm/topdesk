<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A StockQuantitiesItem record from TOPdesk's Asset Management API.
 */
readonly class StockQuantitiesItem extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?BasicBulkItem $bulkItem = null,
        public ?string $etag = null,
        public ?string $id = null,
        public ?int $quantity = null,
        public ?BasicStockWithAssignmentInfo $stock = null,
        public array $extra = [],
    ) {}
}
