<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use spkm\Topdesk\Data\OperationsManagement\Types;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of types for operational activities: GET /tas/api/operationalActivities/types.
 *
 * Returns list of types for operational activities. Client has to have read permission for operational activities
 */
class GetOperationalActivityTypesRequest extends ListRequest
{
    protected ?string $dto = Types::class;

    protected ?string $filterParameter = 'query';

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalActivities/types';
    }
}
