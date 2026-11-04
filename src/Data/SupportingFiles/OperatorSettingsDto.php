<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An OperatorSettingsDto record from TOPdesk's Supporting Files API.
 */
readonly class OperatorSettingsDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Localization $localization = null,
        public array $extra = [],
    ) {}
}
