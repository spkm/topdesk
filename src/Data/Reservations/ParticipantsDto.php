<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ParticipantsDto record from TOPdesk's Reservations API.
 */
readonly class ParticipantsDto extends Data
{
    protected const LISTS = ['persons' => ParticipantDto::class, 'visitors' => ParticipantDto::class];

    /**
     * @param  Collection<int, ParticipantDto>|null  $persons
     * @param  Collection<int, ParticipantDto>|null  $visitors
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $persons = null,
        public ?Collection $visitors = null,
        public array $extra = [],
    ) {}
}
