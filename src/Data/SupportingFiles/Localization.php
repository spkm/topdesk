<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A Localization record from TOPdesk's Supporting Files API.
 */
readonly class Localization extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $language = null,
        public ?bool $useBrowserLocalization = null,
        public array $extra = [],
    ) {}
}
