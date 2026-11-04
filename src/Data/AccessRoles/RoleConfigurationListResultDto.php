<?php

namespace spkm\Topdesk\Data\AccessRoles;

use spkm\Topdesk\Data\Data;

/**
 * A RoleConfigurationListResultDto record from TOPdesk's Access Roles API.
 */
readonly class RoleConfigurationListResultDto extends Data
{
    /**
     * @param  array<string, mixed>|null  $_links
     * @param  array<string, mixed>|null  $_embedded
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $_links = null,
        public ?array $_embedded = null,
        public array $extra = [],
    ) {}
}
