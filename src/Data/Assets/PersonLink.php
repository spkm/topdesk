<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A PersonLink record from TOPdesk's Asset Management API.
 */
readonly class PersonLink extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $inheritanceParentId = null,
        public ?string $linkId = null,
        public ?string $linkedObjectType = null,
        public ?Person $person = null,
        public ?PersonGroup $personGroup = null,
        public array $extra = [],
    ) {}
}
