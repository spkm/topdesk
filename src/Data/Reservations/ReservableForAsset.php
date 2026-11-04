<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A ReservableForAsset record from TOPdesk's Reservations API.
 */
readonly class ReservableForAsset extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $objectId = null,
        public ?string $assetId = null,
        public ?string $name = null,
        public ?bool $standardService = null,
        public array $extra = [],
    ) {}
}
