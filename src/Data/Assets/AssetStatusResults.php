<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An AssetStatusResults record from TOPdesk's Asset Management API.
 */
readonly class AssetStatusResults extends Data
{
    protected const LISTS = ['results' => AssetStatus::class];

    /**
     * @param  Collection<int, AssetStatus>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
