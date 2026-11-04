<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfPersonGroupsV2 record from TOPdesk's Supporting Files API.
 *
 * Represents a paginated list of person groups, including the returned items 'item', result count 'size', and a 'next'
 * page link if available.
 */
readonly class ListOfPersonGroupsV2 extends Data
{
    protected const LISTS = ['item' => PersonGroupV2Dto::class];

    /**
     * @param  Collection<int, PersonGroupV2Dto>|null  $item
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $item = null,
        public ?int $size = null,
        public ?string $next = null,
        public array $extra = [],
    ) {}
}
