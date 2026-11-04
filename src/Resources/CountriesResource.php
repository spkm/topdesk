<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\SupportingFiles\SearchlistDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\Countries\GetCountriesRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The countries endpoints of TOPdesk's Supporting Files API, from Topdesk::countries().
 *
 * @extends Builder<SearchlistDto>
 */
class CountriesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SearchlistDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetCountriesRequest($query);
    }

    /**
     * Get list of countries: GET /tas/api/countries.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getCountries(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetCountriesRequest($query));
    }
}
