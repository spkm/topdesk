<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ListOfRequesterPersonsV2 record from TOPdesk's Supporting Files API.
 *
 * Represents a paginated list of persons, including the returned items 'item', result count 'size', and a 'next' page
 * link if available. The "Department" field format depends on its settings: With "Drop-down list," it includes both
 * 'name' and 'id'. With "Plain text field," it includes only 'name'.
 */
readonly class ListOfRequesterPersonsV2 extends Data
{
    protected const LISTS = ['item' => RequesterPersonV2Dto::class];

    /**
     * @param  Collection<int, RequesterPersonV2Dto>|null  $item
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $item = null,
        public ?int $size = null,
        public ?string $next = null,
        public array $extra = [],
    ) {}
}
