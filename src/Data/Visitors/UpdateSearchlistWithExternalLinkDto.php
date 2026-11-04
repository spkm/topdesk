<?php

namespace spkm\Topdesk\Data\Visitors;

use spkm\Topdesk\Data\Data;

/**
 * An UpdateSearchlistWithExternalLinkDto record from TOPdesk's Visitor Registration API.
 */
readonly class UpdateSearchlistWithExternalLinkDto extends Data
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
