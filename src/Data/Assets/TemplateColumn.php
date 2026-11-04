<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A TemplateColumn record from TOPdesk's Asset Management API.
 */
readonly class TemplateColumn extends Data
{
    protected const LISTS = ['widgets' => Widget::class];

    /**
     * @param  Collection<int, Widget>|null  $widgets
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $size = null,
        public ?Collection $widgets = null,
        public array $extra = [],
    ) {}
}
