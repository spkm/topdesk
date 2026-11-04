<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A ModifyRoomAreaDto record from TOPdesk's Supporting Files API.
 */
readonly class ModifyRoomAreaDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?float $length = null,
        public ?float $width = null,
        public ?float $height = null,
        public ?float $grossFloorArea = null,
        public ?float $netFloorArea = null,
        public ?float $tareFloorArea = null,
        public ?float $functionalArea = null,
        public ?float $lettableArea = null,
        public ?float $communalArea = null,
        public ?float $horizontalCirculationArea = null,
        public ?float $verticalCirculationArea = null,
        public ?float $grossVolume = null,
        public ?float $netVolume = null,
        public array $extra = [],
    ) {}
}
