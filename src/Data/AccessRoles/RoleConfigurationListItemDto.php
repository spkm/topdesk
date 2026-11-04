<?php

namespace spkm\Topdesk\Data\AccessRoles;

use spkm\Topdesk\Data\Data;

/**
 * A RoleConfigurationListItemDto record from TOPdesk's Access Roles API.
 */
readonly class RoleConfigurationListItemDto extends Data
{
    /**
     * @param  array<string, mixed>|null  $_links
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $_links = null,
        public ?string $id = null,
        public ?bool $ready = null,
        public array $extra = [],
    ) {}
}
