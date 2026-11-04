<?php

namespace spkm\Topdesk\Requests\PersonGroups;

use spkm\Topdesk\Data\SupportingFiles\PersonV2Dto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get list of persons of a persongroup by id (v2): GET /tas/api/persongroups/{id}/persons.
 *
 * NOTE: This endpoint matches in behavior with the /persons/ endpoint.
 */
class GetPersonGroupPersonsRequest extends ListRequest
{
    protected ?string $dto = PersonV2Dto::class;

    protected ?string $accept = 'application/x.topdesk-collection-person-v2+json';

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
        return '/tas/api/persongroups/'.Path::segment((string) $this->id).'/persons';
    }
}
