<?php

namespace spkm\Topdesk\Data\AccessRoles;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A RoleConfigurationResultDtoV2 record from TOPdesk's Access Roles API.
 */
readonly class RoleConfigurationResultDtoV2 extends Data
{
    protected const LISTS = ['assignedPermissions' => AssignedPermissionDtoV2::class];

    /**
     * @param  array<string, mixed>|null  $_links
     * @param  Collection<int, AssignedPermissionDtoV2>|null  $assignedPermissions
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $_links = null,
        public ?string $id = null,
        public ?CarbonImmutable $createdAt = null,
        public ?bool $ready = null,
        public ?Collection $assignedPermissions = null,
        public ?bool $licensed = null,
        public array $extra = [],
    ) {}
}
