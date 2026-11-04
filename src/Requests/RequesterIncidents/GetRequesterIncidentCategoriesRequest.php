<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Data\Incidents\IncidentCategory;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get list of categories: GET /tas/api/requester/incidents/categories.
 */
class GetRequesterIncidentCategoriesRequest extends ListRequest
{
    protected ?string $dto = IncidentCategory::class;

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
        return '/tas/api/requester/incidents/categories';
    }
}
