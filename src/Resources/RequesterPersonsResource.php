<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\SupportingFiles\CountPersonDto;
use spkm\Topdesk\Data\SupportingFiles\RequesterPersonV2Dto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\RequesterPersons\GetRequesterPersonCountRequest;
use spkm\Topdesk\Requests\RequesterPersons\GetRequesterPersonRequest;
use spkm\Topdesk\Requests\RequesterPersons\GetRequesterPersonsRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The requester persons endpoints of TOPdesk's Supporting Files API, from Topdesk::requesterPersons().
 *
 * @extends Builder<RequesterPersonV2Dto>
 */
class RequesterPersonsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, RequesterPersonV2Dto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetRequesterPersonsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetRequesterPersonRequest($id);
    }

    /**
     * Get person by id for SSP user. Only returns the person when it is marked as a caller (requester) and is active
     * (not archived): GET /tas/api/requester/persons/{id}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function getRequesterPerson(int|string $id, array $options = []): ?RequesterPersonV2Dto
    {
        return $this->fetch(new GetRequesterPersonRequest($id, $options));
    }

    /**
     * Get total number of persons for SSP user. Only counts persons that are marked as callers (requesters) and are
     * active (not archived): GET /tas/api/requester/persons/count.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: query.
     */
    public function getRequesterPersonCount(array $options = []): ?CountPersonDto
    {
        return $this->fetch(new GetRequesterPersonCountRequest($options));
    }

    /**
     * Get list of persons for SSP user. Only returns persons that are marked as callers (requesters) and are active
     * (not archived): GET /tas/api/requester/persons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<RequesterPersonV2Dto>
     */
    public function getRequesterPersons(): PagedResource
    {
        return new PagedResource($this->connector, RequesterPersonV2Dto::class, fn (Query $query) => new GetRequesterPersonsRequest($query));
    }
}
