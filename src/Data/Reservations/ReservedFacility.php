<?php

namespace spkm\Topdesk\Data\Reservations;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A Reserved Facility record from TOPdesk's Reservations API.
 */
readonly class ReservedFacility extends Data
{
    protected const LISTS = ['reservedServices' => ReservedService::class];

    /**
     * @param  Collection<int, ReservedService>|null  $reservedServices
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $plannedEndDate = null,
        public ?CarbonImmutable $startDateBlock = null,
        public ?CarbonImmutable $endDateBlock = null,
        public ?CarbonImmutable $issueDate = null,
        public ?CarbonImmutable $returnDate = null,
        public ?ReservedLocation $location = null,
        public ?ReservedObject $object = null,
        public ?ReservedAsset $asset = null,
        public ?Collection $reservedServices = null,
        public array $extra = [],
    ) {}
}
