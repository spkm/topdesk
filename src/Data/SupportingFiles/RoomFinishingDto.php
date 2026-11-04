<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A RoomFinishingDto record from TOPdesk's Supporting Files API.
 */
readonly class RoomFinishingDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?float $ceilingArea = null,
        public ?SearchlistDto $ceilingCovering = null,
        public ?float $floorArea = null,
        public ?SearchlistDto $floorCovering = null,
        public ?float $glassArea = null,
        public ?SearchlistDto $glassMaterial = null,
        public ?float $wallArea = null,
        public ?SearchlistDto $wallCovering = null,
        public array $extra = [],
    ) {}
}
