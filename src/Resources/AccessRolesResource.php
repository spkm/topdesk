<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\AccessRoles\ReportingRoleDto;
use spkm\Topdesk\Data\AccessRoles\RoleListResultDto;
use spkm\Topdesk\Data\AccessRoles\RoleResultDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\AccessRoles\GetReportingRolesRequest;
use spkm\Topdesk\Requests\AccessRoles\GetRoleRequest;
use spkm\Topdesk\Requests\AccessRoles\GetRolesRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The access roles endpoints of TOPdesk's Access Roles API, from Topdesk::accessRoles().
 *
 * @extends Builder<ReportingRoleDto>
 */
class AccessRolesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ReportingRoleDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetReportingRolesRequest($query);
    }

    /**
     * Reporting Roles endpoint returning what permissions are assigned to what users, and what users have what
     * permissions: GET /services/permissions/reporting/1.0.0/roles.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ReportingRoleDto>
     */
    public function getReportingRoles(): PagedResource
    {
        return new PagedResource($this->connector, ReportingRoleDto::class, fn (Query $query) => new GetReportingRolesRequest($query));
    }

    /**
     * Retrieve a role by its id: GET /services/permissions/roles/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getRole(int|string $id, array $options = []): ?RoleResultDto
    {
        return $this->fetch(new GetRoleRequest($id, $options));
    }

    /**
     * Retrieve a list of roles: GET /services/permissions/roles.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: archived, licensed, fields.
     */
    public function getRoles(array $options = []): ?RoleListResultDto
    {
        return $this->fetch(new GetRolesRequest($options));
    }
}
