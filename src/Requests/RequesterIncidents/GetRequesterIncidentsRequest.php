<?php

namespace spkm\Topdesk\Requests\RequesterIncidents;

use spkm\Topdesk\Data\Incidents\RequesterIncident;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of incidents for SSP users: GET /tas/api/requester/incidents.
 */
class GetRequesterIncidentsRequest extends ListRequest
{
    protected ?string $dto = RequesterIncident::class;

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $sortParameter = 'sort';

    protected ?string $offsetParameter = 'pageStart';

    protected ?string $sizeParameter = 'pageSize';

    protected ?int $maxPageSize = 10000;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: dateFormat, all.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/incidents';
    }
}
