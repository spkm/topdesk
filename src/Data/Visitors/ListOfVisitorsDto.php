<?php

namespace spkm\Topdesk\Data\Visitors;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfVisitorsDto record from TOPdesk's Visitor Registration API.
 */
readonly class ListOfVisitorsDto extends Data
{
    protected const LISTS = ['results' => GetSingleVisitorDto::class];

    /**
     * @param  Collection<int, GetSingleVisitorDto>|null  $results
     * @param  array<string, mixed>|null  $_links
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?int $total = null,
        public ?Collection $results = null,
        public ?array $_links = null,
        public array $extra = [],
    ) {}
}
