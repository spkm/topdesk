<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A GridAssetStructureResponse record from TOPdesk's Asset Management API.
 */
readonly class GridAssetStructureResponse extends Data
{
    protected const LISTS = ['columns' => FrontendFieldDefinition::class, 'functionalities' => SimpleFunctionality::class, 'templates' => DataSetItem::class];

    /**
     * @param  Collection<int, FrontendFieldDefinition>|null  $columns
     * @param  array<mixed>|null  $dataSet
     * @param  Collection<int, SimpleFunctionality>|null  $functionalities
     * @param  array<string, mixed>|null  $resources
     * @param  array<string, mixed>|null  $settings
     * @param  Collection<int, DataSetItem>|null  $templates
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $columns = null,
        public ?int $count = null,
        public ?array $dataSet = null,
        public ?Collection $functionalities = null,
        public ?array $resources = null,
        public ?array $settings = null,
        public ?Collection $templates = null,
        public array $extra = [],
    ) {}
}
