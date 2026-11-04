<?php

namespace spkm\Topdesk\Requests\Persons;

use spkm\Topdesk\Data\SupportingFiles\PersonV2Dto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of persons: GET /tas/api/persons.
 *
 * NOTE: This endpoint version is not backward compatible with the previous version of the persons endpoint. For
 * documentation on the previous endpoint version, please refer to the document version 1.58.0. To use the new version
 * (2.x.x) of persons endpoint, include this in your accept header: application/x.topdesk-collection-person-v2+json.
 */
class GetPersonsRequest extends ListRequest
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
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persons';
    }
}
