<?php

namespace spkm\Topdesk\Data\Reservations;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A CreateReservationDto record from TOPdesk's Reservations API.
 */
readonly class CreateReservationDto extends Data
{
    protected const LISTS = ['reservedFacilities' => ReservedFacilityLookupWithServices::class];

    /**
     * @param  Collection<int, ReservedFacilityLookupWithServices>|null  $reservedFacilities
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $briefDescription = null,
        public ?string $notes = null,
        public ?string $status = null,
        public ?Lookup $requester = null,
        public ?Lookup $operatorGroup = null,
        public ?Lookup $operator = null,
        public ?LookupByName $processingStatus = null,
        public ?EditParticipantsDto $participants = null,
        public ?int $numberOfPersons = null,
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $plannedEndDate = null,
        public ?Collection $reservedFacilities = null,
        public ?ExternalLinkDto $externalLink = null,
        public ?OptionalFieldsWriteDto $optionalFields1 = null,
        public ?OptionalFieldsWriteDto $optionalFields2 = null,
        public array $extra = [],
    ) {}
}
