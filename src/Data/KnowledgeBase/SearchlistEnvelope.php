<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A SearchlistEnvelope record from TOPdesk's Knowledge Base API.
 */
readonly class SearchlistEnvelope extends Data
{
    protected const LISTS = ['results' => Searchlist::class];

    /**
     * @param  Collection<int, Searchlist>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
