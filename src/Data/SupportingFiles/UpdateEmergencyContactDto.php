<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An UpdateEmergencyContactDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdateEmergencyContactDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public ?string $relation = null,
        public ?string $telephoneNumber = null,
        public array $extra = [],
    ) {}
}
