<?php

namespace spkm\Topdesk\Requests\AccessRoles;

use spkm\Topdesk\Data\AccessRoles\ReportingRoleDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Reporting Roles endpoint returning what permissions are assigned to what users, and what users have what
 * permissions: GET /services/permissions/reporting/1.0.0/roles.
 *
 * The endpoint returns all the roles with their assigned permissions and the linked users.
 */
class GetReportingRolesRequest extends ListRequest
{
    protected ?string $dto = ReportingRoleDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: $filter.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/services/permissions/reporting/1.0.0/roles';
    }
}
