<?php

namespace spkm\Topdesk\Requests\Persons;

use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get list of optional drop-down values for persons: GET /tas/api/persons/free_fields/{tab}/searchlists/{searchlist}.
 */
class GetPersonFreeFieldSearchlistRequest extends ListRequest
{
    protected ?string $dto = SearchlistWithExternalLinkDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: external_link_id, external_link_type.
     */
    public function __construct(protected int|string $tab, protected int|string $searchlist, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/persons/free_fields/'.Path::segment((string) $this->tab).'/searchlists/'.Path::segment((string) $this->searchlist);
    }
}
