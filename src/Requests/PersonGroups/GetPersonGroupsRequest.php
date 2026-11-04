<?php

namespace spkm\Topdesk\Requests\PersonGroups;

use spkm\Topdesk\Data\SupportingFiles\PersonGroupV2Dto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of person groups (v2): GET /tas/api/persongroups.
 *
 * NOTE: This endpoint version is not backward compatible with the previous version of the persongroups endpoint. For
 * documentation on the previous endpoint version, please refer to the document version 2.5.2. To use the new version
 * of the persongroups endpoint, include this in your accept header:
 * application/x.topdesk-collection-person-group-v2+json.
 */
class GetPersonGroupsRequest extends ListRequest
{
    protected ?string $dto = PersonGroupV2Dto::class;

    protected ?string $accept = 'application/x.topdesk-collection-person-group-v2+json';

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $sortParameter = 'sort';

    protected ?string $offsetParameter = 'pageStart';

    protected ?string $sizeParameter = 'pageSize';

    protected ?int $maxPageSize = 5000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persongroups';
    }
}
