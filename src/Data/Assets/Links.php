<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A Links record from TOPdesk's Asset Management API.
 *
 * List of location and person links
 */
readonly class Links extends Data
{
    protected const LISTS = ['locations' => LocationLink::class, 'persons' => PersonLink::class];

    /**
     * @param  Collection<int, LocationLink>|null  $locations
     * @param  Collection<int, PersonLink>|null  $persons
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $locations = null,
        public ?Collection $persons = null,
        public array $extra = [],
    ) {}
}
