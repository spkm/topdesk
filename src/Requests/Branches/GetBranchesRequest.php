<?php

namespace spkm\Topdesk\Requests\Branches;

use spkm\Topdesk\Data\SupportingFiles\ExtendedBranchDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of branches: GET /tas/api/branches.
 */
class GetBranchesRequest extends ListRequest
{
    protected ?string $dto = ExtendedBranchDto::class;

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = '$fields';

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
        return '/tas/api/branches';
    }
}
