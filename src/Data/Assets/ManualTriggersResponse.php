<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ManualTriggersResponse record from TOPdesk's Asset Management API.
 */
readonly class ManualTriggersResponse extends Data
{
    protected const LISTS = ['actions' => Action::class];

    /**
     * @param  Collection<int, Action>|null  $actions
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $actions = null,
        public array $extra = [],
    ) {}
}
