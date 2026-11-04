<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An IdList record from TOPdesk's Asset Management API.
 */
readonly class IdList extends Data
{
    /**
     * @param  array<mixed>|null  $ids
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $ids = null,
        public array $extra = [],
    ) {}
}
