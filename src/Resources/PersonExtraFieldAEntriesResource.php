<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\PersonExtraFieldAEntries\CreatePersonExtraFieldAEntryRequest;
use spkm\Topdesk\Requests\PersonExtraFieldAEntries\GetPersonExtraFieldAEntriesRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The person extra field a entries endpoints of TOPdesk's Supporting Files API, from
 * Topdesk::personExtraFieldAEntries().
 *
 * @extends Builder<SearchlistWithExternalLinkDto>
 */
class PersonExtraFieldAEntriesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SearchlistWithExternalLinkDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetPersonExtraFieldAEntriesRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreatePersonExtraFieldAEntryRequest($body);
    }

    /**
     * Create a person extra field A entry: POST /tas/api/personExtraFieldAEntries.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createPersonExtraFieldAEntry(array|JsonSerializable $body = [], array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new CreatePersonExtraFieldAEntryRequest($body, $options));
    }

    /**
     * Get the list of non-archived person extra field A entries: GET /tas/api/personExtraFieldAEntries.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistWithExternalLinkDto>
     */
    public function getPersonExtraFieldAEntries(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistWithExternalLinkDto::class, fn (Query $query) => new GetPersonExtraFieldAEntriesRequest($query));
    }
}
