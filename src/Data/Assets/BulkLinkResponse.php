<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A BulkLinkResponse record from TOPdesk's Asset Management API.
 */
readonly class BulkLinkResponse extends Data
{
    protected const LISTS = ['results' => LinkResponse::class];

    /**
     * @param  Collection<int, LinkResponse>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
