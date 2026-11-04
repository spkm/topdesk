<?php

namespace spkm\Topdesk\Data\Reservations;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A ReservableAssetIntervalDto record from TOPdesk's Reservations API.
 */
readonly class ReservableAssetIntervalDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?CarbonImmutable $start = null,
        public ?CarbonImmutable $end = null,
        public ?string $objectId = null,
        public ?string $assetId = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
