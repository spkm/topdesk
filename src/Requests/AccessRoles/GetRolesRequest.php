<?php

namespace spkm\Topdesk\Requests\AccessRoles;

use spkm\Topdesk\Data\AccessRoles\RoleListResultDto;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Retrieve a list of roles: GET /services/permissions/roles.
 *
 * Retrieves a list of roles, filtered by the supplied parameters. Permission group read permission is required.
 */
class GetRolesRequest extends GetRequest
{
    protected ?string $dto = RoleListResultDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: archived, licensed, fields.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/permissions/roles';
    }
}
