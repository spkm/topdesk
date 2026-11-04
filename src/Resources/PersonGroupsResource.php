<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\ArchivePersonGroupResponse;
use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Data\SupportingFiles\PersonGroupV2Dto;
use spkm\Topdesk\Data\SupportingFiles\PersonV2Dto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\PersonGroups\ArchivePersonGroupRequest;
use spkm\Topdesk\Requests\PersonGroups\CreatePersonGroupRequest;
use spkm\Topdesk\Requests\PersonGroups\GetPersonGroupLookupRequest;
use spkm\Topdesk\Requests\PersonGroups\GetPersonGroupLookupsRequest;
use spkm\Topdesk\Requests\PersonGroups\GetPersonGroupPersonsRequest;
use spkm\Topdesk\Requests\PersonGroups\GetPersonGroupRequest;
use spkm\Topdesk\Requests\PersonGroups\GetPersonGroupsRequest;
use spkm\Topdesk\Requests\PersonGroups\UnarchivePersonGroupRequest;
use spkm\Topdesk\Requests\PersonGroups\UpdatePersonGroupRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The person groups endpoints of TOPdesk's Supporting Files API, from Topdesk::personGroups().
 *
 * @extends Builder<PersonGroupV2Dto>
 */
class PersonGroupsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, PersonGroupV2Dto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetPersonGroupsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetPersonGroupRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreatePersonGroupRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdatePersonGroupRequest($id, $body);
    }

    /**
     * Archive a person group: POST /tas/api/persongroups/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archivePersonGroup(int|string $id, array|JsonSerializable $body = [], array $options = []): ?ArchivePersonGroupResponse
    {
        return $this->fetch(new ArchivePersonGroupRequest($id, $body, $options));
    }

    /**
     * Create a person group: POST /tas/api/persongroups.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createPersonGroup(array|JsonSerializable $body, array $options = []): ?PersonGroupV2Dto
    {
        return $this->fetch(new CreatePersonGroupRequest($body, $options));
    }

    /**
     * Get person group by id (v2): GET /tas/api/persongroups/{id}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function getPersonGroup(int|string $id, array $options = []): ?PersonGroupV2Dto
    {
        return $this->fetch(new GetPersonGroupRequest($id, $options));
    }

    /**
     * Returns a person group id, name pair: GET /tas/api/persongroups/lookup/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getPersonGroupLookup(int|string $id, array $options = []): ?LookupEntry
    {
        return $this->fetch(new GetPersonGroupLookupRequest($id, $options));
    }

    /**
     * Returns person group id, name pairs: GET /tas/api/persongroups/lookup.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<LookupEntry>
     */
    public function getPersonGroupLookups(): PagedResource
    {
        return new PagedResource($this->connector, LookupEntry::class, fn (Query $query) => new GetPersonGroupLookupsRequest($query));
    }

    /**
     * Get list of persons of a persongroup by id (v2): GET /tas/api/persongroups/{id}/persons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<PersonV2Dto>
     */
    public function getPersonGroupPersons(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, PersonV2Dto::class, fn (Query $query) => new GetPersonGroupPersonsRequest($id, $query));
    }

    /**
     * Get list of person groups (v2): GET /tas/api/persongroups.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<PersonGroupV2Dto>
     */
    public function getPersonGroups(): PagedResource
    {
        return new PagedResource($this->connector, PersonGroupV2Dto::class, fn (Query $query) => new GetPersonGroupsRequest($query));
    }

    /**
     * Unarchive a person group: POST /tas/api/persongroups/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchivePersonGroup(int|string $id, array $options = []): ?ArchivePersonGroupResponse
    {
        return $this->fetch(new UnarchivePersonGroupRequest($id, $options));
    }

    /**
     * Update a person group by id: PATCH /tas/api/persongroups/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updatePersonGroup(int|string $id, array|JsonSerializable $body, array $options = []): ?PersonGroupV2Dto
    {
        return $this->fetch(new UpdatePersonGroupRequest($id, $body, $options));
    }
}
