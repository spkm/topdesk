<?php

namespace spkm\Topdesk\Data\LookAndFeel;

use spkm\Topdesk\Data\Data;

/**
 * A LookAndFeel record from TOPdesk's Self-Service Portal Look and Feel API.
 */
readonly class LookAndFeel extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $color = null,
        public ?bool $useSmallTiles = null,
        public ?string $logoURL = null,
        public ?string $searchBannerURL = null,
        public ?string $title = null,
        public ?string $searchText = null,
        public array $extra = [],
    ) {}
}
