<?php

namespace spkm\Topdesk\Requests\AccessRoles;

use spkm\Topdesk\Data\AccessRoles\RoleResultDto;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Retrieve a role by its id: GET /services/permissions/roles/{id}.
 *
 * Retrieves a single role. Permission group read permission is required.
 */
class GetRoleRequest extends GetRequest
{
    protected ?string $dto = RoleResultDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/permissions/roles/'.Path::segment((string) $this->id);
    }
}
