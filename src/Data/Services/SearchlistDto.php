<?php

namespace spkm\Topdesk\Data\Services;

use spkm\Topdesk\Data\Data;

/**
 * A SearchlistDto record from TOPdesk's Services API.
 */
readonly class SearchlistDto extends Data
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
