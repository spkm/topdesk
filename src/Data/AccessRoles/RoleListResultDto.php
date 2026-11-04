<?php

namespace spkm\Topdesk\Data\AccessRoles;

use spkm\Topdesk\Data\Data;

/**
 * A RoleListResultDto record from TOPdesk's Access Roles API.
 */
readonly class RoleListResultDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?RoleListLinks $_links = null,
        public ?RoleListEmbedded $_embedded = null,
        public array $extra = [],
    ) {}
}
