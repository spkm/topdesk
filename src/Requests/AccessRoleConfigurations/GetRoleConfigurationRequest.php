<?php

namespace spkm\Topdesk\Requests\AccessRoleConfigurations;

use spkm\Topdesk\Data\AccessRoles\RoleConfigurationResultDtoV2;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Retrieve the roleConfiguration by id: GET /services/permissions/roleConfigurations/{id}.
 *
 * Retrieves a permission configuration.
 */
class GetRoleConfigurationRequest extends GetRequest
{
    protected ?string $dto = RoleConfigurationResultDtoV2::class;

    protected ?string $accept = 'application/x.topdesk-role-configuration-v2+json';

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/permissions/roleConfigurations/'.Path::segment((string) $this->id);
    }
}
