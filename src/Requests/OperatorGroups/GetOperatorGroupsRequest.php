<?php

namespace spkm\Topdesk\Requests\OperatorGroups;

use spkm\Topdesk\Data\SupportingFiles\OperatorGroupDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of operator groups: GET /tas/api/operatorgroups.
 */
class GetOperatorGroupsRequest extends ListRequest
{
    protected ?string $dto = OperatorGroupDto::class;

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
        return '/tas/api/operatorgroups';
    }
}
