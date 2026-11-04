<?php

namespace spkm\Topdesk\Data\AccessRoles;

use spkm\Topdesk\Data\Data;

/**
 * A RoleListItemDto record from TOPdesk's Access Roles API.
 */
readonly class RoleListItemDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?RoleLinks $_links = null,
        public ?string $id = null,
        public ?string $name = null,
        public ?bool $licensed = null,
        public array $extra = [],
    ) {}
}
