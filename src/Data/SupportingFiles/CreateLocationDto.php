<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A CreateLocationDto record from TOPdesk's Supporting Files API.
 */
readonly class CreateLocationDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public ?string $roomNumber = null,
        public ?SearchlistDto $branch = null,
        public ?SearchlistDto $functionalUse = null,
        public ?SearchlistDto $type = null,
        public ?int $capacity = null,
        public ?string $specification = null,
        public ?SearchlistDto $budgetHolder = null,
        public ?SearchlistDto $buildingZone = null,
        public ?SearchlistDto $roomStatus = null,
        public ?string $roomSetup = null,
        public ?SearchlistDto $majorLocation = null,
        public ?ModifyRoomAreaDto $area = null,
        public ?ModifyRoomFinishingDto $finishing = null,
        public ?ModifyRoomReservationManagementDto $reservationManagement = null,
        public ?ModifyOptionalFieldsWithNameLookUpDto $optionalFields1 = null,
        public ?ModifyOptionalFieldsWithNameLookUpDto $optionalFields2 = null,
        public ?string $notes = null,
        public array $extra = [],
    ) {}
}
