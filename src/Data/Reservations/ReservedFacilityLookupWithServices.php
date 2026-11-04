<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ReservedFacilityLookupWithServices record from TOPdesk's Reservations API.
 */
readonly class ReservedFacilityLookupWithServices extends Data
{
    protected const LISTS = ['services' => LookupByName::class];

    /**
     * @param  Collection<int, LookupByName>|null  $services
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Lookup $location = null,
        public ?LookupByName $object = null,
        public ?LookupByName $asset = null,
        public ?Collection $services = null,
        public array $extra = [],
    ) {}
}
