<?php

namespace spkm\Topdesk\Data\Visitors;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A GetSearchlistsDto record from TOPdesk's Visitor Registration API.
 */
readonly class GetSearchlistsDto extends Data
{
    protected const LISTS = ['results' => FullSearchlistDto::class];

    /**
     * @param  Collection<int, FullSearchlistDto>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
