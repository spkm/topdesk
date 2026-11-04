<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An EditParticipantsDto record from TOPdesk's Reservations API.
 */
readonly class EditParticipantsDto extends Data
{
    protected const LISTS = ['persons' => Lookup::class, 'visitors' => LookupByNumber::class];

    /**
     * @param  Collection<int, Lookup>|null  $persons
     * @param  Collection<int, LookupByNumber>|null  $visitors
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $persons = null,
        public ?Collection $visitors = null,
        public array $extra = [],
    ) {}
}
