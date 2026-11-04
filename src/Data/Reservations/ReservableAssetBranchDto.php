<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A ReservableAssetBranchDto record from TOPdesk's Reservations API.
 */
readonly class ReservableAssetBranchDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $timeZone = null,
        public array $extra = [],
    ) {}
}
