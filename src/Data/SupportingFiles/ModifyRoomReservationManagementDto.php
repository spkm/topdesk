<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A ModifyRoomReservationManagementDto record from TOPdesk's Supporting Files API.
 */
readonly class ModifyRoomReservationManagementDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $reservable = null,
        public ?bool $issuable = null,
        public ?int $blockTime = null,
        public ?bool $visibleInSsd = null,
        public ?bool $reservableInSsd = null,
        public ?bool $requiresApproval = null,
        public ?string $reservableBy = null,
        public ?SearchlistDto $reservableByPersonGroup = null,
        public ?string $serviceWindowAppliesTo = null,
        public ?SearchlistDto $serviceWindow = null,
        public ?float $price = null,
        public ?float $highRate = null,
        public ?string $pricePer = null,
        public ?float $deposit = null,
        public ?string $extraInformation = null,
        public ?string $leaseText = null,
        public array $extra = [],
    ) {}
}
