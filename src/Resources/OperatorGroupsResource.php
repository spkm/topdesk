<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Data\SupportingFiles\OperatorGroupDto;
use spkm\Topdesk\Data\SupportingFiles\SearchlistDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\OperatorGroups\ArchiveOperatorGroupRequest;
use spkm\Topdesk\Requests\OperatorGroups\ArchiveOperatorGroupWithPutRequest;
use spkm\Topdesk\Requests\OperatorGroups\CreateOperatorGroupRequest;
use spkm\Topdesk\Requests\OperatorGroups\GetOperatorGroupLookupRequest;
use spkm\Topdesk\Requests\OperatorGroups\GetOperatorGroupLookupsRequest;
use spkm\Topdesk\Requests\OperatorGroups\GetOperatorGroupOperatorsRequest;
use spkm\Topdesk\Requests\OperatorGroups\GetOperatorGroupRequest;
use spkm\Topdesk\Requests\OperatorGroups\GetOperatorGroupsRequest;
use spkm\Topdesk\Requests\OperatorGroups\ReplaceOperatorGroupRequest;
use spkm\Topdesk\Requests\OperatorGroups\UnarchiveOperatorGroupRequest;
use spkm\Topdesk\Requests\OperatorGroups\UnarchiveOperatorGroupWithPutRequest;
use spkm\Topdesk\Requests\OperatorGroups\UpdateOperatorGroupRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The operator groups endpoints of TOPdesk's Supporting Files API, from Topdesk::operatorGroups().
 *
 * @extends Builder<OperatorGroupDto>
 */
class OperatorGroupsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, OperatorGroupDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetOperatorGroupsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetOperatorGroupRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateOperatorGroupRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateOperatorGroupRequest($id, $body);
    }

    /**
     * Archive an operator group: PATCH /tas/api/operatorgroups/id/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveOperatorGroup(int|string $id, array|JsonSerializable $body = [], array $options = []): ?OperatorGroupDto
    {
        return $this->fetch(new ArchiveOperatorGroupRequest($id, $body, $options));
    }

    /**
     * Archive an operator group: PUT /tas/api/operatorgroups/id/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveOperatorGroupWithPut(int|string $id, array|JsonSerializable $body = [], array $options = []): ?OperatorGroupDto
    {
        return $this->fetch(new ArchiveOperatorGroupWithPutRequest($id, $body, $options));
    }

    /**
     * Create an operator group: POST /tas/api/operatorgroups.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperatorGroup(array|JsonSerializable $body, array $options = []): ?OperatorGroupDto
    {
        return $this->fetch(new CreateOperatorGroupRequest($body, $options));
    }

    /**
     * Get operator group by id: GET /tas/api/operatorgroups/id/{id}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function getOperatorGroup(int|string $id, array $options = []): ?OperatorGroupDto
    {
        return $this->fetch(new GetOperatorGroupRequest($id, $options));
    }

    /**
     * Returns an operator group id, name pair: GET /tas/api/operatorgroups/lookup/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOperatorGroupLookup(int|string $id, array $options = []): ?LookupEntry
    {
        return $this->fetch(new GetOperatorGroupLookupRequest($id, $options));
    }

    /**
     * Returns operator group id, name pairs: GET /tas/api/operatorgroups/lookup.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<LookupEntry>
     */
    public function getOperatorGroupLookups(): PagedResource
    {
        return new PagedResource($this->connector, LookupEntry::class, fn (Query $query) => new GetOperatorGroupLookupsRequest($query));
    }

    /**
     * Get the operators of an operator group: GET /tas/api/operatorgroups/id/{id}/operators.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getOperatorGroupOperators(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetOperatorGroupOperatorsRequest($id, $query));
    }

    /**
     * Get list of operator groups: GET /tas/api/operatorgroups.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<OperatorGroupDto>
     */
    public function getOperatorGroups(): PagedResource
    {
        return new PagedResource($this->connector, OperatorGroupDto::class, fn (Query $query) => new GetOperatorGroupsRequest($query));
    }

    /**
     * Update an operator group by id: PUT /tas/api/operatorgroups/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceOperatorGroup(int|string $id, array|JsonSerializable $body, array $options = []): ?OperatorGroupDto
    {
        return $this->fetch(new ReplaceOperatorGroupRequest($id, $body, $options));
    }

    /**
     * Unarchive an operator group: PATCH /tas/api/operatorgroups/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveOperatorGroup(int|string $id, array $options = []): ?OperatorGroupDto
    {
        return $this->fetch(new UnarchiveOperatorGroupRequest($id, $options));
    }

    /**
     * Unarchive an operator group: PUT /tas/api/operatorgroups/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveOperatorGroupWithPut(int|string $id, array $options = []): ?OperatorGroupDto
    {
        return $this->fetch(new UnarchiveOperatorGroupWithPutRequest($id, $options));
    }

    /**
     * Update an operator group by id: PATCH /tas/api/operatorgroups/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateOperatorGroup(int|string $id, array|JsonSerializable $body, array $options = []): ?OperatorGroupDto
    {
        return $this->fetch(new UpdateOperatorGroupRequest($id, $body, $options));
    }
}
