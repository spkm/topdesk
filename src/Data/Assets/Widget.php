<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A Widget record from TOPdesk's Asset Management API.
 */
readonly class Widget extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $resourceKey = null,
        public ?string $title = null,
        public array $extra = [],
    ) {}
}
