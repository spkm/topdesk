<?php

namespace spkm\Topdesk\Requests\RequesterVisitors;

use spkm\Topdesk\Data\Visitors\GetSingleVisitorDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get visitors for SSP user: GET /tas/api/requester/visitors.
 *
 * Fields with a null or otherwise empty value will not be included in the response at all, even if they are included
 * in the fields parameter. The result is only available if SSP users can view visitors in the SSP. This endpoint is
 * not available for operators.
 */
class GetRequesterVisitorsRequest extends ListRequest
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
        return '/tas/api/requester/visitors';
    }
}
