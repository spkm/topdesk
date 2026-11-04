<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Data\Incidents\TimeSpent;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Register time spent on an incident by id: GET /tas/api/incidents/id/{id}/timespent.
 */
class GetIncidentTimeSpentRequest extends ListRequest
{
    protected ?string $dto = TimeSpent::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(protected int|string $id, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/id/'.Path::segment((string) $this->id).'/timespent';
    }
}
