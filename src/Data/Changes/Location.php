<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A Location record from TOPdesk's Change Management API.
 */
readonly class Location extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?NameIdPair $branch = null,
        public ?NameIdPair $specificLocation = null,
        public array $extra = [],
    ) {}
}
