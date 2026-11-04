<?php

namespace spkm\Topdesk\Requests\VisitorOptionalSearchlists;

use spkm\Topdesk\Data\Visitors\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get optional searchlists: GET /tas/api/visitorOptionalSearchlist/{tab}/{searchlist}.
 */
class GetVisitorOptionalSearchlistRequest extends ListRequest
{
    protected ?string $dto = SearchlistWithExternalLinkDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: archived.
     */
    public function __construct(protected int|string $tab, protected int|string $searchlist, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/visitorOptionalSearchlist/'.Path::segment((string) $this->tab).'/'.Path::segment((string) $this->searchlist);
    }
}
