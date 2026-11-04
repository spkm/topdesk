<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\SupportingFiles\LanguageDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\Languages\GetLanguagesRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The languages endpoints of TOPdesk's Supporting Files API, from Topdesk::languages().
 *
 * @extends Builder<LanguageDto>
 */
class LanguagesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, LanguageDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetLanguagesRequest($query);
    }

    /**
     * Get list of languages: GET /tas/api/languages.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<LanguageDto>
     */
    public function getLanguages(): PagedResource
    {
        return new PagedResource($this->connector, LanguageDto::class, fn (Query $query) => new GetLanguagesRequest($query));
    }
}
