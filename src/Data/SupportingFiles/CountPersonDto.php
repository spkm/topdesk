<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A CountPersonDto record from TOPdesk's Supporting Files API.
 */
readonly class CountPersonDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?int $numberOfPersons = null,
        public array $extra = [],
    ) {}
}
