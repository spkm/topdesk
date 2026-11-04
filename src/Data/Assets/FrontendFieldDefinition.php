<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A FrontendFieldDefinition record from TOPdesk's Asset Management API.
 */
readonly class FrontendFieldDefinition extends Data
{
    protected const ALIASES = ['etag' => '@etag'];

    protected const LISTS = ['functionalities' => SimpleFunctionality::class];

    /**
     * @param  Collection<int, SimpleFunctionality>|null  $functionalities
     * @param  array<string, mixed>|null  $properties
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $etag = null,
        public ?string $displayName = null,
        public ?string $fieldName = null,
        public ?string $fieldType = null,
        public ?Collection $functionalities = null,
        public ?array $properties = null,
        public ?string $resourceKey = null,
        public ?bool $sortable = null,
        public ?string $valueType = null,
        public array $extra = [],
    ) {}
}
