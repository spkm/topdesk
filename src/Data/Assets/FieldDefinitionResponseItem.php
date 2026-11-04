<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A FieldDefinitionResponseItem record from TOPdesk's Asset Management API.
 *
 * Contains information about a field
 */
readonly class FieldDefinitionResponseItem extends Data
{
    /**
     * @param  array<string, mixed>|null  $properties
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $archived = null,
        public ?string $icon = null,
        public ?string $id = null,
        public ?array $properties = null,
        public ?string $text = null,
        public array $extra = [],
    ) {}
}
