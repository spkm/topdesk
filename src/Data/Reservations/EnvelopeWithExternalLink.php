<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An EnvelopeWithExternalLink record from TOPdesk's Reservations API.
 */
readonly class EnvelopeWithExternalLink extends Data
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
