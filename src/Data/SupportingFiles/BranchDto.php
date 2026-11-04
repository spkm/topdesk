<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A BranchDto record from TOPdesk's Supporting Files API.
 */
readonly class BranchDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $clientReferenceNumber = null,
        public ?string $timeZone = null,
        public ?SearchlistDto $extraA = null,
        public ?SearchlistDto $extraB = null,
        public array $extra = [],
    ) {}
}
