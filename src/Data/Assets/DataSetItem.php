<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A DataSetItem record from TOPdesk's Asset Management API.
 */
readonly class DataSetItem extends Data
{
    protected const LISTS = ['functionalities' => SimpleFunctionality::class];

    /**
     * @param  Collection<int, SimpleFunctionality>|null  $functionalities
     * @param  array<string, mixed>|null  $properties
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $archived = null,
        public ?Collection $functionalities = null,
        public ?string $icon = null,
        public ?string $id = null,
        public ?Inheritance $inheritance = null,
        public ?array $properties = null,
        public ?string $text = null,
        public array $extra = [],
    ) {}
}
