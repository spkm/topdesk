<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A BasicTargetData record from TOPdesk's Asset Management API.
 *
 * Contains basic information about the asset type or bulk item.
 */
readonly class BasicTargetData extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $archived = null,
        public ?string $icon = null,
        public ?string $id = null,
        public ?string $name = null,
        public ?string $type = null,
        public array $extra = [],
    ) {}
}
