<?php

namespace spkm\Topdesk\Data\AccessRoles;

use spkm\Topdesk\Data\Data;

/**
 * A ReportingRoleDto record from TOPdesk's Access Roles API.
 */
readonly class ReportingRoleDto extends Data
{
    /**
     * @param  array<mixed>|null  $principals
     * @param  array<mixed>|null  $assignedPermissions
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?bool $archived = null,
        public ?string $target = null,
        public ?array $principals = null,
        public ?array $assignedPermissions = null,
        public array $extra = [],
    ) {}
}
