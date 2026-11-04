<?php

namespace spkm\Topdesk\Data\AccessRoles;

use spkm\Topdesk\Data\Data;

/**
 * An AssignedPermissionDtoV2 record from TOPdesk's Access Roles API.
 */
readonly class AssignedPermissionDtoV2 extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $permissionId = null,
        public array $extra = [],
    ) {}
}
