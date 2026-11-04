<?php

namespace spkm\Topdesk\Requests\ReservationOptionalSearchlists;

use spkm\Topdesk\Data\Reservations\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the optional searchlist: GET /tas/api/reservationsOptionalSearchlist/{tab}/{searchlist}.
 *
 * Returns the list of possible values for the requested optional searchlist
 */
class GetReservationOptionalSearchlistRequest extends ListRequest
{
    protected ?string $dto = SearchlistWithExternalLinkDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: archived, external_link_id, external_link_type.
     */
    public function __construct(protected int|string $tab, protected int|string $searchlist, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/reservationsOptionalSearchlist/'.Path::segment((string) $this->tab).'/'.Path::segment((string) $this->searchlist);
    }
}
