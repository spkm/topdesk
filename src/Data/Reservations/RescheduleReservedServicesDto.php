<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A RescheduleReservedServicesDto record from TOPdesk's Reservations API.
 */
readonly class RescheduleReservedServicesDto extends Data
{
    protected const LISTS = ['addServices' => LookupByName::class, 'removeServices' => Lookup::class];

    /**
     * @param  Collection<int, LookupByName>|null  $addServices
     * @param  Collection<int, Lookup>|null  $removeServices
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?ReservedFacilityLookup $facility = null,
        public ?Collection $addServices = null,
        public ?Collection $removeServices = null,
        public array $extra = [],
    ) {}
}
