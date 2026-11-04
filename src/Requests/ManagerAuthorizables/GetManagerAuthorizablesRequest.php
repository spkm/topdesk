<?php

namespace spkm\Topdesk\Requests\ManagerAuthorizables;

use spkm\Topdesk\Data\Changes\ManagerAuthorizableEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of changes or authorization activities for which the currently logged in user is the manager: GET
 * /tas/api/managerAuthorizables.
 *
 * Please note that all archived authorization activities and changes are filtered out.
 */
class GetManagerAuthorizablesRequest extends ListRequest
{
    protected ?string $dto = ManagerAuthorizableEntry::class;

    protected ?string $sortParameter = 'sort';

    protected ?string $sizeParameter = 'pageSize';

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: managerAction, includeCount.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/managerAuthorizables';
    }
}
