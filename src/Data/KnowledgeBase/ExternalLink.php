<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An ExternalLink record from TOPdesk's Knowledge Base API.
 */
readonly class ExternalLink extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $type = null,
        public ?CarbonImmutable $date = null,
        public array $extra = [],
    ) {}
}
