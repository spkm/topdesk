<?php

namespace spkm\Topdesk\Data\Changes;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A PossibleStatusValues record from TOPdesk's Change Management API.
 */
readonly class PossibleStatusValues extends Data
{
    protected const LISTS = ['notStarting' => NameIdPair::class, 'starting' => NameIdPair::class, 'implementing' => NameIdPair::class, 'closing' => NameIdPair::class];

    /**
     * @param  Collection<int, NameIdPair>|null  $notStarting
     * @param  Collection<int, NameIdPair>|null  $starting
     * @param  Collection<int, NameIdPair>|null  $implementing
     * @param  Collection<int, NameIdPair>|null  $closing
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $notStarting = null,
        public ?Collection $starting = null,
        public ?Collection $implementing = null,
        public ?Collection $closing = null,
        public array $extra = [],
    ) {}
}
