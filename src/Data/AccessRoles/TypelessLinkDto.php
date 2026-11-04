<?php

namespace spkm\Topdesk\Data\AccessRoles;

use spkm\Topdesk\Data\Data;

/**
 * A TypelessLinkDto record from TOPdesk's Access Roles API.
 */
readonly class TypelessLinkDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $href = null,
        public array $extra = [],
    ) {}
}
