<?php

namespace spkm\Topdesk\Data\Visitors;

use spkm\Topdesk\Data\Data;

/**
 * A CreateSearchlistWithExternalLinkDto record from TOPdesk's Visitor Registration API.
 */
readonly class CreateSearchlistWithExternalLinkDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public ?bool $archived = null,
        public ?ExternalLinkDto $externalLink = null,
        public array $extra = [],
    ) {}
}
