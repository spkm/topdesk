<?php

namespace spkm\Topdesk\Data\Reservations;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ReservableAssetDto record from TOPdesk's Reservations API.
 */
readonly class ReservableAssetDto extends Data
{
    protected const LISTS = ['reservableIntervals' => ReservableIntervalDto::class];

    /**
     * @param  Collection<int, ReservableIntervalDto>|null  $reservableIntervals
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $assetId = null,
        public ?string $assetName = null,
        public ?ReservableAssetAssignments $assignments = null,
        public ?Collection $reservableIntervals = null,
        public array $extra = [],
    ) {}
}
