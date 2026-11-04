<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\PersonExtraFieldBEntries\CreatePersonExtraFieldBEntryRequest;
use spkm\Topdesk\Requests\PersonExtraFieldBEntries\GetPersonExtraFieldBEntriesRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The person extra field b entries endpoints of TOPdesk's Supporting Files API, from
 * Topdesk::personExtraFieldBEntries().
 *
 * @extends Builder<SearchlistWithExternalLinkDto>
 */
class PersonExtraFieldBEntriesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SearchlistWithExternalLinkDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetPersonExtraFieldBEntriesRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreatePersonExtraFieldBEntryRequest($body);
    }

    /**
     * Create a person extra field B entry: POST /tas/api/personExtraFieldBEntries.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createPersonExtraFieldBEntry(array|JsonSerializable $body = [], array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new CreatePersonExtraFieldBEntryRequest($body, $options));
    }

    /**
     * Get the list of non-archived person extra field B entries: GET /tas/api/personExtraFieldBEntries.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistWithExternalLinkDto>
     */
    public function getPersonExtraFieldBEntries(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistWithExternalLinkDto::class, fn (Query $query) => new GetPersonExtraFieldBEntriesRequest($query));
    }
}
