<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A BasicBranch record from TOPdesk's Asset Management API.
 *
 * The branch assigned to the stock, if any. If a location is assigned to the stock, then the value is the branch of
 * the location.
 */
readonly class BasicBranch extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
