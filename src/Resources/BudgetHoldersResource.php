<?php

namespace spkm\Topdesk\Resources;

use Illuminate\Support\Collection;
use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\BudgetHolders\ArchiveBudgetHolderRequest;
use spkm\Topdesk\Requests\BudgetHolders\CreateBudgetHolderRequest;
use spkm\Topdesk\Requests\BudgetHolders\DeleteBudgetHolderRequest;
use spkm\Topdesk\Requests\BudgetHolders\GetBudgetHoldersRequest;
use spkm\Topdesk\Requests\BudgetHolders\UnarchiveBudgetHolderRequest;
use spkm\Topdesk\Requests\BudgetHolders\UpdateBudgetHolderRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The budget holders endpoints of TOPdesk's Supporting Files API, from Topdesk::budgetHolders().
 *
 * @extends Builder<SearchlistWithExternalLinkDto>
 */
class BudgetHoldersResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, SearchlistWithExternalLinkDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetBudgetHoldersRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateBudgetHolderRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateBudgetHolderRequest($id, $body);
    }

    protected function deleteRequest(int|string $id): TopdeskRequest
    {
        return new DeleteBudgetHolderRequest($id);
    }

    /**
     * Archive a budget holder: PATCH /tas/api/budgetholders/id/{id}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveBudgetHolder(int|string $id, array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new ArchiveBudgetHolderRequest($id, $options));
    }

    /**
     * Create a budget holder: POST /tas/api/budgetholders.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createBudgetHolder(array|JsonSerializable $body = [], array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new CreateBudgetHolderRequest($body, $options));
    }

    /**
     * Delete a budget holder: DELETE /tas/api/budgetholders/id/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteBudgetHolder(int|string $id, array $options = []): bool
    {
        return $this->perform(new DeleteBudgetHolderRequest($id, $options));
    }

    /**
     * Get list of budgetholders: GET /tas/api/budgetholders.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistWithExternalLinkDto>
     */
    public function getBudgetHolders(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistWithExternalLinkDto::class, fn (Query $query) => new GetBudgetHoldersRequest($query));
    }

    /**
     * Unarchive a budget holder: PATCH /tas/api/budgetholders/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveBudgetHolder(int|string $id, array $options = []): ?SearchlistWithExternalLinkDto
    {
        return $this->fetch(new UnarchiveBudgetHolderRequest($id, $options));
    }

    /**
     * Updates the name-value of a budget holder: PATCH /tas/api/budgetholders/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     * @return Collection<int, SearchlistWithExternalLinkDto>
     */
    public function updateBudgetHolder(int|string $id, array|JsonSerializable $body = [], array $options = []): Collection
    {
        return $this->fetch(new UpdateBudgetHolderRequest($id, $body, $options));
    }
}
