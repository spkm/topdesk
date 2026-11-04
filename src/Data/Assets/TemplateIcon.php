<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A TemplateIcon record from TOPdesk's Asset Management API.
 *
 * Icon of the linked asset's template
 */
readonly class TemplateIcon extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $url16 = null,
        public ?string $url32 = null,
        public array $extra = [],
    ) {}
}
