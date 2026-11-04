<?php

namespace spkm\Topdesk\Data\KnowledgeBase;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A VisibilityWrite record from TOPdesk's Knowledge Base API.
 */
readonly class VisibilityWrite extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $sspVisibility = null,
        public ?CarbonImmutable $sspVisibleFrom = null,
        public ?CarbonImmutable $sspVisibleUntil = null,
        public ?bool $sspVisibilityFilteredOnBranches = null,
        public ?bool $operatorVisibilityFilteredOnBranches = null,
        public array $extra = [],
    ) {}
}
