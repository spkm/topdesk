<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An AssetTemplateStructure record from TOPdesk's Asset Management API.
 *
 * Structure of the template
 */
readonly class AssetTemplateStructure extends Data
{
    protected const LISTS = ['tabs' => TemplateTab::class];

    /**
     * @param  array<mixed>|null  $required
     * @param  Collection<int, TemplateTab>|null  $tabs
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $required = null,
        public ?Collection $tabs = null,
        public array $extra = [],
    ) {}
}
