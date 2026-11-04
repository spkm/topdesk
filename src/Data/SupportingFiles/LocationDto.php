<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A LocationDto record from TOPdesk's Supporting Files API.
 */
readonly class LocationDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?BranchDto $branch = null,
        public ?string $name = null,
        public ?string $room = null,
        public array $extra = [],
    ) {}
}
