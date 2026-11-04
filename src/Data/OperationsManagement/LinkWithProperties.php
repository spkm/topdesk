<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use spkm\Topdesk\Data\Data;

/**
 * A linkWithProperties record from TOPdesk's Operations Management API.
 */
readonly class LinkWithProperties extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?IdAndName $branch = null,
        public ?IdAndName $location = null,
        public ?IdAndName $type = null,
        public array $extra = [],
    ) {}
}
