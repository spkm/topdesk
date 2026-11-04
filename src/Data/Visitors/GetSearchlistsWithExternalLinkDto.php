<?php

namespace spkm\Topdesk\Data\Visitors;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A GetSearchlistsWithExternalLinkDto record from TOPdesk's Visitor Registration API.
 */
readonly class GetSearchlistsWithExternalLinkDto extends Data
{
    protected const LISTS = ['results' => SearchlistWithExternalLinkDto::class];

    /**
     * @param  Collection<int, SearchlistWithExternalLinkDto>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
