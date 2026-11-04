<?php

namespace spkm\Topdesk\Requests\Branches;

use spkm\Topdesk\Data\SupportingFiles\SearchlistDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of building levels: GET /tas/api/branches/buildingLevels.
 */
class GetBranchBuildingLevelsRequest extends ListRequest
{
    protected ?string $dto = SearchlistDto::class;

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
        return '/tas/api/branches/buildingLevels';
    }
}
