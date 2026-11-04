<?php

namespace spkm\Topdesk\Data\Visitors;

use spkm\Topdesk\Data\Data;

/**
 * A SearchlistWithExternalLinkDto record from TOPdesk's Visitor Registration API.
 */
readonly class SearchlistWithExternalLinkDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?bool $archived = null,
        public ?ExternalLinkDto $externalLink = null,
        public array $extra = [],
    ) {}
}
