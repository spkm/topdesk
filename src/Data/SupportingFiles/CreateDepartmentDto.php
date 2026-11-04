<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A CreateDepartmentDto record from TOPdesk's Supporting Files API.
 */
readonly class CreateDepartmentDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public ?ExternalLinkDto $externalLink = null,
        public array $extra = [],
    ) {}
}
