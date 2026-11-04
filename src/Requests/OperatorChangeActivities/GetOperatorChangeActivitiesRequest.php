<?php

namespace spkm\Topdesk\Requests\OperatorChangeActivities;

use spkm\Topdesk\Data\Changes\ChangeActivityEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get a list of change activities: GET /tas/api/operatorChangeActivities.
 *
 * Get a list of change activities. Use the fields parameter to select only the fields you are interested in and filter
 * the results with the parameter query.
 */
class GetOperatorChangeActivitiesRequest extends ListRequest
{
    protected ?string $dto = ChangeActivityEntry::class;

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $sortParameter = 'sort';

    protected ?string $offsetParameter = 'pageStart';

    protected ?string $sizeParameter = 'pageSize';

    protected ?int $maxPageSize = 5000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: change, operator, operatorGroup, archived, id, status, finalDateAfter, blocked, open.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChangeActivities';
    }
}
