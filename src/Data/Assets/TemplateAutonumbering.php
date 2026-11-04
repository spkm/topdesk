<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A TemplateAutonumbering record from TOPdesk's Asset Management API.
 *
 * Autonumbering for the template
 */
readonly class TemplateAutonumbering extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $enabled = null,
        public ?int $minLength = null,
        public ?string $prefix = null,
        public ?int $startIndex = null,
        public array $extra = [],
    ) {}
}
