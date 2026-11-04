<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * A ConfigurationObjectDetailed record from TOPdesk's Change Management API.
 */
readonly class ConfigurationObjectDetailed extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $objectId = null,
        public ?string $objectType = null,
        public ?NameIdPair $branch = null,
        public ?NameIdPair $location = null,
        public array $extra = [],
    ) {}
}
