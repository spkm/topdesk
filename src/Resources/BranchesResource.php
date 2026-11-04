<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\SupportingFiles\BranchAttachmentDto;
use spkm\Topdesk\Data\SupportingFiles\ExtendedBranchDto;
use spkm\Topdesk\Data\SupportingFiles\LookupEntry;
use spkm\Topdesk\Data\SupportingFiles\SearchlistDto;
use spkm\Topdesk\Data\SupportingFiles\SearchlistWithExternalLinkDto;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\Branches\ArchiveBranchRequest;
use spkm\Topdesk\Requests\Branches\ArchiveBranchWithPutRequest;
use spkm\Topdesk\Requests\Branches\CreateBranchAttachmentRequest;
use spkm\Topdesk\Requests\Branches\CreateBranchRequest;
use spkm\Topdesk\Requests\Branches\DeleteBranchAttachmentRequest;
use spkm\Topdesk\Requests\Branches\DownloadBranchAttachmentRequest;
use spkm\Topdesk\Requests\Branches\GetBranchAttachmentsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchBuildingLevelsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchDesignationsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchEnergyPerformancesRequest;
use spkm\Topdesk\Requests\Branches\GetBranchEnvironmentalImpactsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchesRequest;
use spkm\Topdesk\Requests\Branches\GetBranchFreeFieldSearchlistRequest;
use spkm\Topdesk\Requests\Branches\GetBranchListedBuildingsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchLookupRequest;
use spkm\Topdesk\Requests\Branches\GetBranchLookupsRequest;
use spkm\Topdesk\Requests\Branches\GetBranchRequest;
use spkm\Topdesk\Requests\Branches\ReplaceBranchRequest;
use spkm\Topdesk\Requests\Branches\UnarchiveBranchRequest;
use spkm\Topdesk\Requests\Branches\UnarchiveBranchWithPutRequest;
use spkm\Topdesk\Requests\Branches\UpdateBranchRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;
use SplFileInfo;

/**
 * The branches endpoints of TOPdesk's Supporting Files API, from Topdesk::branches().
 *
 * @extends Builder<ExtendedBranchDto>
 */
class BranchesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, ExtendedBranchDto::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetBranchesRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetBranchRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateBranchRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateBranchRequest($id, $body);
    }

    /**
     * Archive a branch: PATCH /tas/api/branches/id/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveBranch(int|string $id, array|JsonSerializable $body = [], array $options = []): ?ExtendedBranchDto
    {
        return $this->fetch(new ArchiveBranchRequest($id, $body, $options));
    }

    /**
     * Archive a branch: PUT /tas/api/branches/id/{id}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveBranchWithPut(int|string $id, array|JsonSerializable $body = [], array $options = []): ?ExtendedBranchDto
    {
        return $this->fetch(new ArchiveBranchWithPutRequest($id, $body, $options));
    }

    /**
     * Create a branch: POST /tas/api/branches.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createBranch(array|JsonSerializable $body, array $options = []): ?ExtendedBranchDto
    {
        return $this->fetch(new CreateBranchRequest($body, $options));
    }

    /**
     * Upload an attachment to a branch: POST /tas/api/branches/id/{id}/attachments.
     *
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createBranchAttachment(int|string $id, mixed $file, ?string $filename = null, array $fields = [], array $options = []): ?BranchAttachmentDto
    {
        return $this->fetch(new CreateBranchAttachmentRequest($id, $file, $filename, $fields, $options));
    }

    /**
     * Delete a branch attachment: DELETE /tas/api/branches/id/{id}/attachments/{attachmentId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteBranchAttachment(int|string $id, int|string $attachmentId, array $options = []): bool
    {
        return $this->perform(new DeleteBranchAttachmentRequest($id, $attachmentId, $options));
    }

    /**
     * Download an attachment: GET /tas/api/branches/id/{id}/attachments/{attachmentId}/download.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function downloadBranchAttachment(int|string $id, int|string $attachmentId, array $options = []): ?string
    {
        return $this->fetch(new DownloadBranchAttachmentRequest($id, $attachmentId, $options));
    }

    /**
     * Get details of branch by id: GET /tas/api/branches/id/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getBranch(int|string $id, array $options = []): ?ExtendedBranchDto
    {
        return $this->fetch(new GetBranchRequest($id, $options));
    }

    /**
     * Get the list of attachments of a branch: GET /tas/api/branches/id/{id}/attachments.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<BranchAttachmentDto>
     */
    public function getBranchAttachments(int|string $id): PagedResource
    {
        return new PagedResource($this->connector, BranchAttachmentDto::class, fn (Query $query) => new GetBranchAttachmentsRequest($id, $query));
    }

    /**
     * Get list of building levels: GET /tas/api/branches/buildingLevels.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getBranchBuildingLevels(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetBranchBuildingLevelsRequest($query));
    }

    /**
     * Get list of branch designations: GET /tas/api/branches/designations.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getBranchDesignations(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetBranchDesignationsRequest($query));
    }

    /**
     * Get list of energy performances: GET /tas/api/branches/energyPerformances.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getBranchEnergyPerformances(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetBranchEnergyPerformancesRequest($query));
    }

    /**
     * Get list of environmental impacts: GET /tas/api/branches/environmentalImpacts.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getBranchEnvironmentalImpacts(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetBranchEnvironmentalImpactsRequest($query));
    }

    /**
     * Get list of optional drop-down values for branches: GET
     * /tas/api/branches/free_fields/{tab}/searchlists/{searchlist}.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistWithExternalLinkDto>
     */
    public function getBranchFreeFieldSearchlist(int|string $tab, int|string $searchlist): PagedResource
    {
        return new PagedResource($this->connector, SearchlistWithExternalLinkDto::class, fn (Query $query) => new GetBranchFreeFieldSearchlistRequest($tab, $searchlist, $query));
    }

    /**
     * Get list of listed buildings: GET /tas/api/branches/listedBuildings.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<SearchlistDto>
     */
    public function getBranchListedBuildings(): PagedResource
    {
        return new PagedResource($this->connector, SearchlistDto::class, fn (Query $query) => new GetBranchListedBuildingsRequest($query));
    }

    /**
     * Returns a branch id, name pair: GET /tas/api/branches/lookup/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getBranchLookup(int|string $id, array $options = []): ?LookupEntry
    {
        return $this->fetch(new GetBranchLookupRequest($id, $options));
    }

    /**
     * Returns branch id, name pairs: GET /tas/api/branches/lookup.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<LookupEntry>
     */
    public function getBranchLookups(): PagedResource
    {
        return new PagedResource($this->connector, LookupEntry::class, fn (Query $query) => new GetBranchLookupsRequest($query));
    }

    /**
     * Get list of branches: GET /tas/api/branches.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<ExtendedBranchDto>
     */
    public function getBranches(): PagedResource
    {
        return new PagedResource($this->connector, ExtendedBranchDto::class, fn (Query $query) => new GetBranchesRequest($query));
    }

    /**
     * Update a branch by id: PUT /tas/api/branches/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceBranch(int|string $id, array|JsonSerializable $body, array $options = []): ?ExtendedBranchDto
    {
        return $this->fetch(new ReplaceBranchRequest($id, $body, $options));
    }

    /**
     * Unarchive a branch: PATCH /tas/api/branches/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveBranch(int|string $id, array $options = []): ?ExtendedBranchDto
    {
        return $this->fetch(new UnarchiveBranchRequest($id, $options));
    }

    /**
     * Unarchive a branch: PUT /tas/api/branches/id/{id}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveBranchWithPut(int|string $id, array $options = []): ?ExtendedBranchDto
    {
        return $this->fetch(new UnarchiveBranchWithPutRequest($id, $options));
    }

    /**
     * Update a branch by id: PATCH /tas/api/branches/id/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateBranch(int|string $id, array|JsonSerializable $body, array $options = []): ?ExtendedBranchDto
    {
        return $this->fetch(new UpdateBranchRequest($id, $body, $options));
    }
}
