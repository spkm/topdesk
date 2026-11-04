<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An InheritanceParent record from TOPdesk's Asset Management API.
 *
 * Only for inherited assignments: contains data about the parent asset where the assignment is inherited from.
 */
readonly class InheritanceParent extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $iconId = null,
        public ?string $id = null,
        public ?string $name = null,
        public array $extra = [],
    ) {}
}
