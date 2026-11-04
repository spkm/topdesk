<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Data\Incidents\Searchlist;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get list of optional drop-down values: GET /tas/api/incidents/free_fields/{tab}/searchlists/{searchlist}.
 */
class GetIncidentFreeFieldSearchlistRequest extends ListRequest
{
    protected ?string $dto = Searchlist::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(protected int|string $tab, protected int|string $searchlist, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/free_fields/'.Path::segment((string) $this->tab).'/searchlists/'.Path::segment((string) $this->searchlist);
    }
}
