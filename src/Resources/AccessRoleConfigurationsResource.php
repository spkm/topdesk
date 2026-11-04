<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\AccessRoles\RoleConfigurationListResultDto;
use spkm\Topdesk\Data\AccessRoles\RoleConfigurationResultDtoV2;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Requests\AccessRoleConfigurations\GetRoleConfigurationRequest;
use spkm\Topdesk\Requests\AccessRoleConfigurations\GetRoleConfigurationsRequest;

/**
 * The access role configurations endpoints of TOPdesk's Access Roles API, from Topdesk::accessRoleConfigurations().
 *
 * @extends BaseResource<Data>
 */
class AccessRoleConfigurationsResource extends BaseResource
{
    /**
     * Retrieve the roleConfiguration by id: GET /services/permissions/roleConfigurations/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getRoleConfiguration(int|string $id, array $options = []): ?RoleConfigurationResultDtoV2
    {
        return $this->fetch(new GetRoleConfigurationRequest($id, $options));
    }

    /**
     * Retrieves a list of roleConfigurations: GET /services/permissions/roleConfigurations.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: roleId.
     */
    public function getRoleConfigurations(array $options = []): ?RoleConfigurationListResultDto
    {
        return $this->fetch(new GetRoleConfigurationsRequest($options));
    }
}
