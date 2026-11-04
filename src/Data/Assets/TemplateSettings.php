<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A TemplateSettings record from TOPdesk's Asset Management API.
 *
 * Settings for the template
 */
readonly class TemplateSettings extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $visibleOnSSP = null,
        public array $extra = [],
    ) {}
}
