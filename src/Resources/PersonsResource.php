<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\CountPersonDto;
use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Data\SupportingFiles\PersonContractV2Dto;
use spkm\Topdesk\Data\SupportingFiles\PersonDto;
use spkm\Topdesk\Data\SupportingFiles\PersonGroupV2Dto;
use spkm\Topdesk\Data\SupportingFiles\PersonPrivateDetailsV2Dto;
use spkm\Topdesk\Data\SupportingFiles\PersonV2Dto;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Data\SupportingFiles\SimpleAvatarDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\Persons\ArchivePersonRequest;
use spkm\Topdesk\Requests\Persons\ArchivePersonWithPutRequest;
use spkm\Topdesk\Requests\Persons\CreatePersonFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Persons\CreatePersonRequest;
use spkm\Topdesk\Requests\Persons\GetCurrentPersonRequest;
use spkm\Topdesk\Requests\Persons\GetPersonAvatarRequest;
use spkm\Topdesk\Requests\Persons\GetPersonContractRequest;
use spkm\Topdesk\Requests\Persons\GetPersonCountRequest;
use spkm\Topdesk\Requests\Persons\GetPersonFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Persons\GetPersonLookupRequest;
use spkm\Topdesk\Requests\Persons\GetPersonLookupsRequest;
use spkm\Topdesk\Requests\Persons\GetPersonPersonGroupsRequest;
use spkm\Topdesk\Requests\Persons\GetPersonPrivateDetailsRequest;
use spkm\Topdesk\Requests\Persons\GetPersonRequest;
use spkm\Topdesk\Requests\Persons\GetPersonsRequest;
use spkm\Topdesk\Requests\Persons\UnarchivePersonRequest;
use spkm\Topdesk\Requests\Persons\UnarchivePersonWithPutRequest;
use spkm\Topdesk\Requests\Persons\UpdatePersonContractRequest;
use spkm\Topdesk\Requests\Persons\UpdatePersonPrivateDetailsRequest;
use spkm\Topdesk\Requests\Persons\UpdatePersonRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The persons endpoints of TOPdesk's Supporting Files API, from Topdesk::persons().
 *
 * @extends Builder<PersonV2Dto>
 */
class PersonsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, PersonV2Dto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetPersonsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetPersonRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreatePersonRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdatePersonRequest($id, $body);
    }

    /**
     * Archive a person and its linked operator if there is one: PATCH /tas/api/persons/id/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archivePerson(int|string $id, array|JsonSerializable $body = [], array $options = []): ?PersonDto
    {
        return $this->fetch(new ArchivePersonRequest($id, $body, $options));
    }

    /**
     * Archive a person and its linked operator if there is one: PUT /tas/api/persons/id/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archivePersonWithPut(int|string $id, array|JsonSerializable $body = [], array $options = []): ?PersonDto
    {
        return $this->fetch(new ArchivePersonWithPutRequest($id, $body, $options));
    }

    /**
     * Create a person: POST /tas/api/persons.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createPerson(array|JsonSerializable $body, array $options = []): ?PersonV2Dto
    {
        return $this->fetch(new CreatePersonRequest($body, $options));
    }

    /**
     * Create an optional person drop-down list entry: POST
     * /tas/api/persons/free_fields/{tab}/searchlists/{searchlist}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createPersonFreeFieldSearchlist(int|string $tab, int|string $searchlist, array|JsonSerializable $body = [], array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new CreatePersonFreeFieldSearchlistRequest($tab, $searchlist, $body, $options));
    }

    /**
     * Get logged in person: GET /tas/api/persons/current.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getCurrentPerson(array $options = []): ?PersonDto
    {
        return $this->fetch(new GetCurrentPersonRequest($options));
    }

    /**
     * Get person by id (v2): GET /tas/api/persons/{id}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function getPerson(int|string $id, array $options = []): ?PersonV2Dto
    {
        return $this->fetch(new GetPersonRequest($id, $options));
    }

    /**
     * Get a person's avatar: GET /tas/api/persons/id/{id}/avatar.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getPersonAvatar(int|string $id, array $options = []): ?SimpleAvatarDto
    {
        return $this->fetch(new GetPersonAvatarRequest($id, $options));
    }

    /**
     * Get a person's contract: GET /tas/api/persons/{id}/contract.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function getPersonContract(int|string $id, array $options = []): ?PersonContractV2Dto
    {
        return $this->fetch(new GetPersonContractRequest($id, $options));
    }

    /**
     * Get total number of persons: GET /tas/api/persons/count.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: query.
     */
    public function getPersonCount(array $options = []): ?CountPersonDto
    {
        return $this->fetch(new GetPersonCountRequest($options));
    }

    /**
     * Get list of optional drop-down values for persons: GET
     * /tas/api/persons/free_fields/{tab}/searchlists/{searchlist}.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistWithExternalLinkDto>
     */
    public function getPersonFreeFieldSearchlist(int|string $tab, int|string $searchlist): PagedResource
    {
        return new PagedResource($this->connector, SearchlistWithExternalLinkDto::class, fn (Query $query) => new GetPersonFreeFieldSearchlistRequest($tab, $searchlist, $query));
    }

    /**
     * Returns a person id, name pair: GET /tas/api/persons/lookup/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getPersonLookup(int|string $id, array $options = []): ?LookupEntry
    {
        return $this->fetch(new GetPersonLookupRequest($id, $options));
    }

    /**
     * Returns person id, name pairs: GET /tas/api/persons/lookup.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<LookupEntry>
     */
    public function getPersonLookups(): PagedResource
    {
        return new PagedResource($this->connector, LookupEntry::class, fn (Query $query) => new GetPersonLookupsRequest($query));
    }

    /**
     * Get list of person groups of a person by id (v2): GET /tas/api/persons/{id}/persongroups.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<PersonGroupV2Dto>
     */
    public function getPersonPersonGroups(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, PersonGroupV2Dto::class, fn (Query $query) => new GetPersonPersonGroupsRequest($id, $query));
    }

    /**
     * Get a person's private details: GET /tas/api/persons/{id}/privateDetails.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function getPersonPrivateDetails(int|string $id, array $options = []): ?PersonPrivateDetailsV2Dto
    {
        return $this->fetch(new GetPersonPrivateDetailsRequest($id, $options));
    }

    /**
     * Get list of persons: GET /tas/api/persons.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<PersonV2Dto>
     */
    public function getPersons(): PagedResource
    {
        return new PagedResource($this->connector, PersonV2Dto::class, fn (Query $query) => new GetPersonsRequest($query));
    }

    /**
     * Unarchive a person: PATCH /tas/api/persons/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchivePerson(int|string $id, array $options = []): ?PersonDto
    {
        return $this->fetch(new UnarchivePersonRequest($id, $options));
    }

    /**
     * Unarchive a person: PUT /tas/api/persons/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchivePersonWithPut(int|string $id, array $options = []): ?PersonDto
    {
        return $this->fetch(new UnarchivePersonWithPutRequest($id, $options));
    }

    /**
     * Update a person by id (v2): PATCH /tas/api/persons/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updatePerson(int|string $id, array|JsonSerializable $body, array $options = []): ?PersonV2Dto
    {
        return $this->fetch(new UpdatePersonRequest($id, $body, $options));
    }

    /**
     * Update a person's contract: PATCH /tas/api/persons/{id}/contract.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updatePersonContract(int|string $id, array|JsonSerializable $body, array $options = []): ?PersonContractV2Dto
    {
        return $this->fetch(new UpdatePersonContractRequest($id, $body, $options));
    }

    /**
     * Update a person's private details: PATCH /tas/api/persons/{id}/privateDetails.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updatePersonPrivateDetails(int|string $id, array|JsonSerializable $body, array $options = []): ?PersonPrivateDetailsV2Dto
    {
        return $this->fetch(new UpdatePersonPrivateDetailsRequest($id, $body, $options));
    }
}
