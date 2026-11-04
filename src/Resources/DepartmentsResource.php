<?php

namespace spkm\Topdesk\Resources;

use Illuminate\Support\Collection;
use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\Departments\ArchiveDepartmentRequest;
use spkm\Topdesk\Requests\Departments\CreateDepartmentRequest;
use spkm\Topdesk\Requests\Departments\DeleteDepartmentRequest;
use spkm\Topdesk\Requests\Departments\GetDepartmentsRequest;
use spkm\Topdesk\Requests\Departments\UnarchiveDepartmentRequest;
use spkm\Topdesk\Requests\Departments\UpdateDepartmentRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The departments endpoints of TOPdesk's Supporting Files API, from Topdesk::departments().
 *
 * @extends Builder<SearchlistWithExternalLinkDto>
 */
class DepartmentsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SearchlistWithExternalLinkDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetDepartmentsRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateDepartmentRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateDepartmentRequest($id, $body);
    }

    protected function deleteRequest(int|string $id): TopdeskRequest
    {
        return new DeleteDepartmentRequest($id);
    }

    /**
     * Archive a department: PATCH /tas/api/departments/id/{id}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveDepartment(int|string $id, array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new ArchiveDepartmentRequest($id, $options));
    }

    /**
     * Create department: POST /tas/api/departments.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createDepartment(array|JsonSerializable $body, array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new CreateDepartmentRequest($body, $options));
    }

    /**
     * Delete a department: DELETE /tas/api/departments/id/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteDepartment(int|string $id, array $options = []): bool
    {
        return $this->perform(new DeleteDepartmentRequest($id, $options));
    }

    /**
     * Get list of departments: GET /tas/api/departments.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistWithExternalLinkDto>
     */
    public function getDepartments(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistWithExternalLinkDto::class, fn (Query $query) => new GetDepartmentsRequest($query));
    }

    /**
     * Unarchive a department: PATCH /tas/api/departments/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveDepartment(int|string $id, array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new UnarchiveDepartmentRequest($id, $options));
    }

    /**
     * Updates the name-value of a department: PATCH /tas/api/departments/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     * @return Collection<int, SearchlistWithExternalLinkDto>
     */
    public function updateDepartment(int|string $id, array|JsonSerializable $body = [], array $options = []): Collection
    {
        return $this->fetch(new UpdateDepartmentRequest($id, $body, $options));
    }
}
