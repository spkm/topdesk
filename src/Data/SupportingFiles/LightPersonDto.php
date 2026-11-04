<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A LightPersonDto record from TOPdesk's Supporting Files API.
 */
readonly class LightPersonDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $dynamicName = null,
        public array $extra = [],
    ) {}
}
