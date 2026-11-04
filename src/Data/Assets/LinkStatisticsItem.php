<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A LinkStatisticsItem record from TOPdesk's Asset Management API.
 */
readonly class LinkStatisticsItem extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?int $countOfLinkedResources = null,
        public ?int $countOfLinks = null,
        public ?BasicTargetData $target = null,
        public array $extra = [],
    ) {}
}
