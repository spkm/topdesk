<?php

namespace spkm\Topdesk\Requests\AccessRoleConfigurations;

use spkm\Topdesk\Data\AccessRoles\RoleConfigurationListResultDto;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Retrieves a list of roleConfigurations: GET /services/permissions/roleConfigurations.
 *
 * Retrieve all roleConfigurations or all roleConfigurations for a specific list of roles.
 */
class GetRoleConfigurationsRequest extends GetRequest
{
    protected ?string $dto = RoleConfigurationListResultDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: roleId.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/permissions/roleConfigurations';
    }
}
