<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A Field record from TOPdesk's Asset Management API.
 */
readonly class Field extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $defaultUniqueKey = null,
        public ?string $displayName = null,
        public ?string $key = null,
        public ?ForeignKeyOperations $operations = null,
        public ?bool $readOnly = null,
        public ?bool $required = null,
        public ?string $type = null,
        public array $extra = [],
    ) {}
}
