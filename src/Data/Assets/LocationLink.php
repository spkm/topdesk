<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A LocationLink record from TOPdesk's Asset Management API.
 */
readonly class LocationLink extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Branch $branch = null,
        public ?string $inheritanceParentId = null,
        public ?string $linkId = null,
        public ?string $linkedObjectType = null,
        public ?Location $location = null,
        public array $extra = [],
    ) {}
}
