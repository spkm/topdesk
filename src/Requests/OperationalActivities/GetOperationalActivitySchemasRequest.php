<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use spkm\Topdesk\Data\OperationsManagement\Schemas;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of schemas for operational activities: GET /tas/api/operationalActivities/schemas.
 *
 * Returns list of schemas for operational activities. Client has to have read permission for operational activities or
 * read permission for schemas.
 */
class GetOperationalActivitySchemasRequest extends ListRequest
{
    protected ?string $dto = Schemas::class;

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $sortParameter = 'sort';

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
        return '/tas/api/operationalActivities/schemas';
    }
}
