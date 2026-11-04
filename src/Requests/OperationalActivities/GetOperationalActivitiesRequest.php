<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use spkm\Topdesk\Data\OperationsManagement\OperationalActivityWithAllFields;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get operational activities: GET /tas/api/operationalActivities.
 *
 * Deprecation: application/x.topdesk-om-activity-v0+json and application/x.topdesk-om-activity-v1+json are deprecated.
 */
class GetOperationalActivitiesRequest extends ListRequest
{
    protected ?string $dto = OperationalActivityWithAllFields::class;

    protected ?string $accept = 'application/x.topdesk-collection-om-activity-v1+json';

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $sortParameter = 'sort';

    protected ?string $offsetParameter = 'pageStart';

    protected ?string $sizeParameter = 'pageSize';

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operationalActivities';
    }
}
