<?php

namespace spkm\Topdesk\Data\Reservations;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A CreateRequesterReservationDto record from TOPdesk's Reservations API.
 */
readonly class CreateRequesterReservationDto extends Data
{
    protected const LISTS = ['reservedFacilities' => ReservedAsset2::class];

    /**
     * @param  Collection<int, ReservedAsset2>|null  $reservedFacilities
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
