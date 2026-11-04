<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A FieldWithInUse record from TOPdesk's Asset Management API.
 *
 * Response for a field resource
 */
readonly class FieldWithInUse extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $etag = null,
        public ?string $fieldType = null,
        public ?string $id = null,
        public ?bool $inUse = null,
        public ?string $name = null,
        public mixed $properties = null,
        public array $extra = [],
    ) {}
}
