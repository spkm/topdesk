<?php

namespace spkm\Topdesk\Data\Reservations;

use spkm\Topdesk\Data\Data;

/**
 * A WriteSearchlistWithExternalLinkDto record from TOPdesk's Reservations API.
 */
readonly class WriteSearchlistWithExternalLinkDto extends Data
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
