<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An UpdateLanguageDto record from TOPdesk's Supporting Files API.
 */
readonly class UpdateLanguageDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $code = null,
        public array $extra = [],
    ) {}
}
