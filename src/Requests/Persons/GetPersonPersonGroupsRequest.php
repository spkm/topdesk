<?php

namespace spkm\Topdesk\Requests\Persons;

use spkm\Topdesk\Data\SupportingFiles\PersonGroupV2Dto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get list of person groups of a person by id (v2): GET /tas/api/persons/{id}/persongroups.
 *
 * NOTE: This endpoint matches in behavior with the /persongroups/ endpoint.
 */
class GetPersonPersonGroupsRequest extends ListRequest
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
    public function __construct(protected int|string $id, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persons/'.Path::segment((string) $this->id).'/persongroups';
    }
}
