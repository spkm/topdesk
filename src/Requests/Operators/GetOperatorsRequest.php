<?php

namespace spkm\Topdesk\Requests\Operators;

use spkm\Topdesk\Data\SupportingFiles\OperatorDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of operators: GET /tas/api/operators.
 *
 * __ This permission provides more access than required by this API._
 */
class GetOperatorsRequest extends ListRequest
{
    protected ?string $dto = OperatorDto::class;

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $offsetParameter = 'start';

    protected ?string $sizeParameter = 'page_size';

    protected ?int $maxPageSize = 100;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operators';
    }
}
