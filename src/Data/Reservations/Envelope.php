<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An Envelope record from TOPdesk's Reservations API.
 */
readonly class Envelope extends Data
{
    protected const LISTS = ['results' => SearchlistDto::class];

    /**
     * @param  Collection<int, SearchlistDto>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
