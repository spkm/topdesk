<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A RequesterLocationDto record from TOPdesk's Supporting Files API.
 */
readonly class RequesterLocationDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $roomNumber = null,
        public ?SearchlistDto $branch = null,
        public ?SearchlistDto $buildingZone = null,
        public array $extra = [],
    ) {}
}
