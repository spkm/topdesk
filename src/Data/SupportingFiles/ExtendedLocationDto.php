<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An ExtendedLocationDto record from TOPdesk's Supporting Files API.
 */
readonly class ExtendedLocationDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $status = null,
        public ?string $name = null,
        public ?string $roomNumber = null,
        public ?SearchlistDto $functionalUse = null,
        public ?SearchlistDto $type = null,
        public ?int $capacity = null,
        public ?string $specification = null,
        public ?SearchlistDto $budgetHolder = null,
        public ?SearchlistDto $branch = null,
        public ?SearchlistDto $buildingZone = null,
        public ?SearchlistDto $roomStatus = null,
        public ?string $roomSetup = null,
        public ?SearchlistDto $majorLocation = null,
        public ?RoomAreaDto $area = null,
        public ?RoomFinishingDto $finishing = null,
        public ?RoomReservationManagementDto $reservationManagement = null,
        public ?OptionalFieldsDto $optionalFields1 = null,
        public ?OptionalFieldsDto $optionalFields2 = null,
        public ?string $notes = null,
        public ?SearchlistDto $creator = null,
        public ?CarbonImmutable $creationDate = null,
        public ?SearchlistDto $modifier = null,
        public ?CarbonImmutable $modificationDate = null,
        public array $extra = [],
    ) {}
}
