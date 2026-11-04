<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A StockQuantityUpdatePayload record from TOPdesk's Asset Management API.
 *
 * The new value of the quantity for a given relation (between a stock and a bulk item).
 */
readonly class StockQuantityUpdatePayload extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?int $quantity = null,
        public array $extra = [],
    ) {}
}
