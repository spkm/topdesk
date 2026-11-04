<?php

namespace spkm\Topdesk\Requests\Operators;

use spkm\Topdesk\Data\SupportingFiles\FilterDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of operator filters: GET /tas/api/operators/filters/operator.
 */
class GetOperatorFiltersRequest extends ListRequest
{
    protected ?string $dto = FilterDto::class;

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
        return '/tas/api/operators/filters/operator';
    }
}
