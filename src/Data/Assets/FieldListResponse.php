<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A FieldListResponse record from TOPdesk's Asset Management API.
 *
 * Response for getting field list.
 */
readonly class FieldListResponse extends Data
{
    protected const LISTS = ['fields' => FieldWithInUse::class];

    /**
     * @param  Collection<int, FieldWithInUse>|null  $fields
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $fields = null,
        public array $extra = [],
    ) {}
}
