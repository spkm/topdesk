<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A FieldDefinitionListResponse record from TOPdesk's Asset Management API.
 */
readonly class FieldDefinitionListResponse extends Data
{
    protected const LISTS = ['dataSet' => FieldDefinitionResponseItem::class];

    /**
     * @param  Collection<int, FieldDefinitionResponseItem>|null  $dataSet
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $dataSet = null,
        public array $extra = [],
    ) {}
}
