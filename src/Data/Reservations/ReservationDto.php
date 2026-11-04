<?php

namespace spkm\Topdesk\Data\Reservations;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ReservationDto record from TOPdesk's Reservations API.
 *
 * Note that all fields are visible regardless of functionalities enabled in settings
 */
readonly class ReservationDto extends Data
{
    protected const LISTS = ['reservedFacilities' => ReservedFacility::class, 'externalLinks' => ExternalLinkDto::class];

    /**
     * @param  Collection<int, ReservedFacility>|null  $reservedFacilities
     * @param  Collection<int, ExternalLinkDto>|null  $externalLinks
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $status = null,
        public ?string $number = null,
        public ?string $briefDescription = null,
        public ?string $notes = null,
        public ?bool $archived = null,
        public ?Requester $requester = null,
        public ?Requester $reservedForOther = null,
        public ?Operator $operator = null,
        public ?Operator $operatorGroup = null,
        public ?ParticipantsDto $participants = null,
        public ?int $numberOfPersons = null,
        public ?CarbonImmutable $plannedStartDate = null,
        public ?CarbonImmutable $plannedEndDate = null,
        public ?Collection $reservedFacilities = null,
        public ?Event $event = null,
        public ?SearchList $processingStatus = null,
        public ?SeriesDto $series = null,
        public ?Collection $externalLinks = null,
        public ?OptionalFieldsTab $optionalFields1 = null,
        public ?OptionalFieldsTab $optionalFields2 = null,
        public ?CarbonImmutable $modificationDate = null,
        public array $extra = [],
    ) {}
}
