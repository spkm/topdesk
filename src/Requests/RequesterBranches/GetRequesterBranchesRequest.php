<?php

namespace spkm\Topdesk\Requests\RequesterBranches;

use spkm\Topdesk\Data\SupportingFiles\RequesterBranchDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of branches for SSP user: GET /tas/api/requester/branches.
 */
class GetRequesterBranchesRequest extends ListRequest
{
    protected ?string $dto = RequesterBranchDto::class;

    protected ?string $filterParameter = 'query';

    protected ?string $sizeParameter = 'pageSize';

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
        return '/tas/api/requester/branches';
    }
}
