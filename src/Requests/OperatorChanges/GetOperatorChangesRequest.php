<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use spkm\Topdesk\Data\Changes\OperatorChangeEntry;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get a list of changes: GET /tas/api/operatorChanges.
 *
 * Get a list of changes. Use the fields parameter to select only the fields you are interested in and filter the
 * results with the parameter query.
 */
class GetOperatorChangesRequest extends ListRequest
{
    protected ?string $dto = OperatorChangeEntry::class;

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $sortParameter = 'sort';

    protected ?string $offsetParameter = 'pageStart';

    protected ?string $sizeParameter = 'pageSize';

    protected ?int $maxPageSize = 5000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: simple.assignee.groupId, simple.assignee.id, changeType, phase, status, id, closedDate.start, open, archived.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChanges';
    }
}
