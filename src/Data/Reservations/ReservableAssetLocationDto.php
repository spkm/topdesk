<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A ReservableAssetLocationDto record from TOPdesk's Reservations API.
 */
readonly class ReservableAssetLocationDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?ReservableAssetBranchDto $branch = null,
        public ?NameIdDto $location = null,
        public array $extra = [],
    ) {}
}
