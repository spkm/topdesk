<?php

namespace spkm\Topdesk\Requests\Visitors;

use spkm\Topdesk\Data\Visitors\GetSingleVisitorDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get visitors: GET /tas/api/visitors.
 *
 * Fields with a null or otherwise empty value will not be included in the response at all, even if they are included
 * in the fields parameter. Only allowed for operators, for SSP users use /requester/visitors instead.
 */
class GetVisitorsRequest extends ListRequest
{
    protected ?string $dto = GetSingleVisitorDto::class;

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $offsetParameter = 'offset';

    protected ?string $sizeParameter = 'pageSize';

    protected ?int $maxPageSize = 10000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: order.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/visitors';
    }
}
