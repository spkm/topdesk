<?php

namespace spkm\Topdesk\Requests\RequesterPersons;

use spkm\Topdesk\Data\SupportingFiles\RequesterPersonV2Dto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of persons for SSP user. Only returns persons that are marked as callers (requesters) and are active (not
 * archived): GET /tas/api/requester/persons.
 *
 * NOTE: For performance reasons this endpoint will only include a limited set of fields by default. To get different
 * or specific fields, please use the 'fields' parameter.
 */
class GetRequesterPersonsRequest extends ListRequest
{
    protected ?string $dto = RequesterPersonV2Dto::class;

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
        return '/tas/api/requester/persons';
    }
}
