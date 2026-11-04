<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\FilterDto;
use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Data\SupportingFiles\OperatorDto;
use spkm\Topdesk\Data\SupportingFiles\OperatorIdDto;
use spkm\Topdesk\Data\SupportingFiles\OperatorSettingsDto;
use spkm\Topdesk\Data\SupportingFiles\SearchlistDto;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\Operators\ArchiveOperatorRequest;
use spkm\Topdesk\Requests\Operators\ArchiveOperatorWithPutRequest;
use spkm\Topdesk\Requests\Operators\CreateOperatorFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Operators\CreateOperatorRequest;
use spkm\Topdesk\Requests\Operators\GetBranchFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetCategoryFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetCurrentOperatorIdRequest;
use spkm\Topdesk\Requests\Operators\GetCurrentOperatorRequest;
use spkm\Topdesk\Requests\Operators\GetCurrentOperatorSettingsRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorBranchFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorCategoryFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorLookupRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorLookupsRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorOperatorFiltersRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorOperatorGroupsRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorPermissionGroupsRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorRequest;
use spkm\Topdesk\Requests\Operators\GetOperatorsRequest;
use spkm\Topdesk\Requests\Operators\LinkOperatorBranchFiltersRequest;
use spkm\Topdesk\Requests\Operators\LinkOperatorCategoryFiltersRequest;
use spkm\Topdesk\Requests\Operators\LinkOperatorOperatorFiltersRequest;
use spkm\Topdesk\Requests\Operators\LinkOperatorOperatorGroupsRequest;
use spkm\Topdesk\Requests\Operators\LinkOperatorPermissionGroupsRequest;
use spkm\Topdesk\Requests\Operators\ReplaceOperatorRequest;
use spkm\Topdesk\Requests\Operators\UnarchiveOperatorRequest;
use spkm\Topdesk\Requests\Operators\UnarchiveOperatorWithPutRequest;
use spkm\Topdesk\Requests\Operators\UnlinkOperatorBranchFiltersRequest;
use spkm\Topdesk\Requests\Operators\UnlinkOperatorCategoryFiltersRequest;
use spkm\Topdesk\Requests\Operators\UnlinkOperatorOperatorFiltersRequest;
use spkm\Topdesk\Requests\Operators\UnlinkOperatorOperatorGroupsRequest;
use spkm\Topdesk\Requests\Operators\UnlinkOperatorPermissionGroupsRequest;
use spkm\Topdesk\Requests\Operators\UpdateOperatorRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The operators endpoints of TOPdesk's Supporting Files API, from Topdesk::operators().
 *
 * @extends Builder<OperatorDto>
 */
class OperatorsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, OperatorDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetOperatorsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetOperatorRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateOperatorRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateOperatorRequest($id, $body);
    }

    /**
     * Archive an operator: PATCH /tas/api/operators/id/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveOperator(int|string $id, array|JsonSerializable $body = [], array $options = []): ?OperatorDto
    {
        return $this->fetch(new ArchiveOperatorRequest($id, $body, $options));
    }

    /**
     * Archive an operator: PUT /tas/api/operators/id/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveOperatorWithPut(int|string $id, array|JsonSerializable $body = [], array $options = []): ?OperatorDto
    {
        return $this->fetch(new ArchiveOperatorWithPutRequest($id, $body, $options));
    }

    /**
     * Create an operator: POST /tas/api/operators.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperator(array|JsonSerializable $body, array $options = []): ?OperatorDto
    {
        return $this->fetch(new CreateOperatorRequest($body, $options));
    }

    /**
     * Create an optional operator drop-down list entry: POST
     * /tas/api/operators/free_fields/{tab}/searchlists/{searchlist}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createOperatorFreeFieldSearchlist(int|string $tab, int|string $searchlist, array|JsonSerializable $body = [], array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new CreateOperatorFreeFieldSearchlistRequest($tab, $searchlist, $body, $options));
    }

    /**
     * Get list of branch filters: GET /tas/api/operators/filters/branch.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<FilterDto>
     */
    public function getBranchFilters(): PagedResource
    {
        return new PagedResource($this->connector, FilterDto::class, fn (Query $query) => new GetBranchFiltersRequest($query));
    }

    /**
     * Get list of category filters: GET /tas/api/operators/filters/category.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<FilterDto>
     */
    public function getCategoryFilters(): PagedResource
    {
        return new PagedResource($this->connector, FilterDto::class, fn (Query $query) => new GetCategoryFiltersRequest($query));
    }

    /**
     * Get logged in operator: GET /tas/api/operators/current.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function getCurrentOperator(array $options = []): ?OperatorDto
    {
        return $this->fetch(new GetCurrentOperatorRequest($options));
    }

    /**
     * Get the id of the current operator: GET /tas/api/operators/current/id.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getCurrentOperatorId(array $options = []): ?OperatorIdDto
    {
        return $this->fetch(new GetCurrentOperatorIdRequest($options));
    }

    /**
     * Get logged in operator's settings: GET /tas/api/operators/current/settings.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getCurrentOperatorSettings(array $options = []): ?OperatorSettingsDto
    {
        return $this->fetch(new GetCurrentOperatorSettingsRequest($options));
    }

    /**
     * Get operator by id: GET /tas/api/operators/id/{id}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields.
     */
    public function getOperator(int|string $id, array $options = []): ?OperatorDto
    {
        return $this->fetch(new GetOperatorRequest($id, $options));
    }

    /**
     * Get the branch filters of an operator: GET /tas/api/operators/id/{id}/filters/branch.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<FilterDto>
     */
    public function getOperatorBranchFilters(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, FilterDto::class, fn (Query $query) => new GetOperatorBranchFiltersRequest($id, $query));
    }

    /**
     * Get the category filters of an operator: GET /tas/api/operators/id/{id}/filters/category.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<FilterDto>
     */
    public function getOperatorCategoryFilters(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, FilterDto::class, fn (Query $query) => new GetOperatorCategoryFiltersRequest($id, $query));
    }

    /**
     * Get list of operator filters: GET /tas/api/operators/filters/operator.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<FilterDto>
     */
    public function getOperatorFilters(): PagedResource
    {
        return new PagedResource($this->connector, FilterDto::class, fn (Query $query) => new GetOperatorFiltersRequest($query));
    }

    /**
     * Get list of optional drop-down values for operators: GET
     * /tas/api/operators/free_fields/{tab}/searchlists/{searchlist}.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistWithExternalLinkDto>
     */
    public function getOperatorFreeFieldSearchlist(int|string $tab, int|string $searchlist): PagedResource
    {
        return new PagedResource($this->connector, SearchlistWithExternalLinkDto::class, fn (Query $query) => new GetOperatorFreeFieldSearchlistRequest($tab, $searchlist, $query));
    }

    /**
     * Returns an operator id, name pair: GET /tas/api/operators/lookup/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getOperatorLookup(int|string $id, array $options = []): ?LookupEntry
    {
        return $this->fetch(new GetOperatorLookupRequest($id, $options));
    }

    /**
     * Returns operator id, name pairs: GET /tas/api/operators/lookup.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<LookupEntry>
     */
    public function getOperatorLookups(): PagedResource
    {
        return new PagedResource($this->connector, LookupEntry::class, fn (Query $query) => new GetOperatorLookupsRequest($query));
    }

    /**
     * Get the operator filters of an operator: GET /tas/api/operators/id/{id}/filters/operator.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<FilterDto>
     */
    public function getOperatorOperatorFilters(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, FilterDto::class, fn (Query $query) => new GetOperatorOperatorFiltersRequest($id, $query));
    }

    /**
     * Get the operator groups of an operator: GET /tas/api/operators/id/{id}/operatorgroups.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getOperatorOperatorGroups(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetOperatorOperatorGroupsRequest($id, $query));
    }

    /**
     * Get the permission groups of an operator: GET /tas/api/operators/id/{id}/permissiongroups.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getOperatorPermissionGroups(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetOperatorPermissionGroupsRequest($id, $query));
    }

    /**
     * Get list of operators: GET /tas/api/operators.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<OperatorDto>
     */
    public function getOperators(): PagedResource
    {
        return new PagedResource($this->connector, OperatorDto::class, fn (Query $query) => new GetOperatorsRequest($query));
    }

    /**
     * Link branch filters to an operator: POST /tas/api/operators/id/{id}/filters/branch.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function linkOperatorBranchFilters(int|string $id, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new LinkOperatorBranchFiltersRequest($id, $body, $options));
    }

    /**
     * Link category filters to an operator: POST /tas/api/operators/id/{id}/filters/category.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function linkOperatorCategoryFilters(int|string $id, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new LinkOperatorCategoryFiltersRequest($id, $body, $options));
    }

    /**
     * Link operator filters to an operator: POST /tas/api/operators/id/{id}/filters/operator.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function linkOperatorOperatorFilters(int|string $id, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new LinkOperatorOperatorFiltersRequest($id, $body, $options));
    }

    /**
     * Link operator groups to an operator: POST /tas/api/operators/id/{id}/operatorgroups.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function linkOperatorOperatorGroups(int|string $id, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new LinkOperatorOperatorGroupsRequest($id, $body, $options));
    }

    /**
     * Link permission groups to an operator: POST /tas/api/operators/id/{id}/permissiongroups.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function linkOperatorPermissionGroups(int|string $id, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new LinkOperatorPermissionGroupsRequest($id, $body, $options));
    }

    /**
     * Update an operator by id: PUT /tas/api/operators/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceOperator(int|string $id, array|JsonSerializable $body, array $options = []): ?OperatorDto
    {
        return $this->fetch(new ReplaceOperatorRequest($id, $body, $options));
    }

    /**
     * Unarchive an operator and its linked person if there is one: PATCH /tas/api/operators/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveOperator(int|string $id, array $options = []): ?OperatorDto
    {
        return $this->fetch(new UnarchiveOperatorRequest($id, $options));
    }

    /**
     * Unarchive an operator and its linked person if there is one: PUT /tas/api/operators/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveOperatorWithPut(int|string $id, array $options = []): ?OperatorDto
    {
        return $this->fetch(new UnarchiveOperatorWithPutRequest($id, $options));
    }

    /**
     * Unlink branch filters from an operator: DELETE /tas/api/operators/id/{id}/filters/branch.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unlinkOperatorBranchFilters(int|string $id, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UnlinkOperatorBranchFiltersRequest($id, $body, $options));
    }

    /**
     * Unlink category filters from an operator: DELETE /tas/api/operators/id/{id}/filters/category.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unlinkOperatorCategoryFilters(int|string $id, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UnlinkOperatorCategoryFiltersRequest($id, $body, $options));
    }

    /**
     * Unlink operator filters from an operator: DELETE /tas/api/operators/id/{id}/filters/operator.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unlinkOperatorOperatorFilters(int|string $id, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UnlinkOperatorOperatorFiltersRequest($id, $body, $options));
    }

    /**
     * Unlink operator groups from an operator: DELETE /tas/api/operators/id/{id}/operatorgroups.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unlinkOperatorOperatorGroups(int|string $id, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UnlinkOperatorOperatorGroupsRequest($id, $body, $options));
    }

    /**
     * Unlink permission groups from an operator: DELETE /tas/api/operators/id/{id}/permissiongroups.
     *
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unlinkOperatorPermissionGroups(int|string $id, array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new UnlinkOperatorPermissionGroupsRequest($id, $body, $options));
    }

    /**
     * Update an operator by id: PATCH /tas/api/operators/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateOperator(int|string $id, array|JsonSerializable $body, array $options = []): ?OperatorDto
    {
        return $this->fetch(new UpdateOperatorRequest($id, $body, $options));
    }
}
