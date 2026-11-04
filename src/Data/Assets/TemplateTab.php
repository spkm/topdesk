<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A TemplateTab record from TOPdesk's Asset Management API.
 */
readonly class TemplateTab extends Data
{
    protected const LISTS = ['columns' => TemplateColumn::class];

    /**
     * @param  Collection<int, TemplateColumn>|null  $columns
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $columns = null,
        public ?string $resourceKey = null,
        public array $extra = [],
    ) {}
}
