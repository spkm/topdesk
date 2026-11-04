<?php

namespace spkm\Topdesk\Resources;

use Illuminate\Support\Collection;
use JsonSerializable;
use spkm\Topdesk\Data\Assets\AssetData;
use spkm\Topdesk\Data\Assets\AssignmentLinkResponse;
use spkm\Topdesk\Data\Assets\CopyAssetResponseList;
use spkm\Topdesk\Data\Assets\CreatedAsset;
use spkm\Topdesk\Data\Assets\DeleteAssetsResponse;
use spkm\Topdesk\Data\Assets\DeleteGridAssetResponse;
use spkm\Topdesk\Data\Assets\FrontendAsset;
use spkm\Topdesk\Data\Assets\HistoryItemCollection;
use spkm\Topdesk\Data\Assets\LinkResponse;
use spkm\Topdesk\Data\Assets\LinkResults;
use spkm\Topdesk\Data\Assets\Links;
use spkm\Topdesk\Data\Assets\ManualTriggersResponse;
use spkm\Topdesk\Data\Assets\ModifiedAssetResponse;
use spkm\Topdesk\Data\Assets\UnlinkResponse;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\Assets\ArchiveAssetForTemplateRequest;
use spkm\Topdesk\Requests\Assets\ArchiveAssetRequest;
use spkm\Topdesk\Requests\Assets\AssignAssetsRequest;
use spkm\Topdesk\Requests\Assets\CopyAssetRequest;
use spkm\Topdesk\Requests\Assets\CreateAssetForTemplateRequest;
use spkm\Topdesk\Requests\Assets\CreateAssetRequest;
use spkm\Topdesk\Requests\Assets\CreateGridFieldAssetRequest;
use spkm\Topdesk\Requests\Assets\DeleteAssetAssignmentRequest;
use spkm\Topdesk\Requests\Assets\DeleteAssetsRequest;
use spkm\Topdesk\Requests\Assets\DeleteGridFieldAssetRequest;
use spkm\Topdesk\Requests\Assets\FilterAssetsRequest;
use spkm\Topdesk\Requests\Assets\GetAssetActionsRequest;
use spkm\Topdesk\Requests\Assets\GetAssetAssignmentsRequest;
use spkm\Topdesk\Requests\Assets\GetAssetBlankRequest;
use spkm\Topdesk\Requests\Assets\GetAssetHistoryCurrentItemsRequest;
use spkm\Topdesk\Requests\Assets\GetAssetHistoryPastItemsRequest;
use spkm\Topdesk\Requests\Assets\GetAssetRequest;
use spkm\Topdesk\Requests\Assets\GetAssetsRequest;
use spkm\Topdesk\Requests\Assets\GetBlankAssetForTemplateRequest;
use spkm\Topdesk\Requests\Assets\GetGridFieldAssetRequest;
use spkm\Topdesk\Requests\Assets\GetGridFieldValuesRequest;
use spkm\Topdesk\Requests\Assets\LinkAssetsToKnowledgeItemRequest;
use spkm\Topdesk\Requests\Assets\LinkAssetsToServiceRequest;
use spkm\Topdesk\Requests\Assets\LinkAssetsToTaskRequest;
use spkm\Topdesk\Requests\Assets\ReplaceAssetAssignmentsRequest;
use spkm\Topdesk\Requests\Assets\ReplaceAssetBranchesForTemplateRequest;
use spkm\Topdesk\Requests\Assets\ReplaceAssetLocationsForTemplateRequest;
use spkm\Topdesk\Requests\Assets\ReplaceAssetPersonGroupsForTemplateRequest;
use spkm\Topdesk\Requests\Assets\ReplaceAssetPersonsForTemplateRequest;
use spkm\Topdesk\Requests\Assets\UnarchiveAssetRequest;
use spkm\Topdesk\Requests\Assets\UnlinkAssetsRequest;
use spkm\Topdesk\Requests\Assets\UpdateAssetForTemplateRequest;
use spkm\Topdesk\Requests\Assets\UpdateAssetRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The assets endpoints of TOPdesk's Asset Management API, from Topdesk::assets().
 *
 * @extends Builder<Data>
 */
class AssetsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, null);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetAssetsRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetAssetRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateAssetRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateAssetRequest($id, $body);
    }

    /**
     * Archives an asset: POST /tas/api/assetmgmt/assets/{assetId}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveAsset(int|string $assetId, array|JsonSerializable $body, array $options = []): ?FrontendAsset
    {
        return $this->fetch(new ArchiveAssetRequest($assetId, $body, $options));
    }

    /**
     * Archives an asset: POST /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/archive.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveAssetForTemplate(int|string $templateId, int|string $assetId, array|JsonSerializable $body, array $options = []): bool
    {
        return $this->perform(new ArchiveAssetForTemplateRequest($templateId, $assetId, $body, $options));
    }

    /**
     * Add branch, location, person and person group assignments to assets, stocks or bulk items: PUT
     * /tas/api/assetmgmt/assets/assignments.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function assignAssets(array|JsonSerializable $body, array $options = []): ?AssignmentLinkResponse
    {
        return $this->fetch(new AssignAssetsRequest($body, $options));
    }

    /**
     * Copies an asset: POST /tas/api/assetmgmt/assets/{assetId}/copy.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function copyAsset(int|string $assetId, array|JsonSerializable $body, array $options = []): ?CopyAssetResponseList
    {
        return $this->fetch(new CopyAssetRequest($assetId, $body, $options));
    }

    /**
     * Creates a new asset: POST /tas/api/assetmgmt/assets.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createAsset(array|JsonSerializable $body = [], array $options = []): ?FrontendAsset
    {
        return $this->fetch(new CreateAssetRequest($body, $options));
    }

    /**
     * Creates a new asset: POST /tas/api/assetmgmt/assets/templateId/{templateId}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createAssetForTemplate(int|string $templateId, array|JsonSerializable $body, array $options = []): ?CreatedAsset
    {
        return $this->fetch(new CreateAssetForTemplateRequest($templateId, $body, $options));
    }

    /**
     * Updates an existing row: POST /tas/api/assetmgmt/assets/gridFieldAsset.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: assetId, hostAssetId.
     */
    public function createGridFieldAsset(array|JsonSerializable $body, array $options = []): ?FrontendAsset
    {
        return $this->fetch(new CreateGridFieldAssetRequest($body, $options));
    }

    /**
     * Removes an assigned branch, location, person, or person group: DELETE
     * /tas/api/assetmgmt/assets/{assetId}/assignments/{linkId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteAssetAssignment(int|string $assetId, int|string $linkId, array $options = []): bool
    {
        return $this->perform(new DeleteAssetAssignmentRequest($assetId, $linkId, $options));
    }

    /**
     * Deletes several assets: POST /tas/api/assetmgmt/assets/delete.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteAssets(array|JsonSerializable $body = [], array $options = []): ?DeleteAssetsResponse
    {
        return $this->fetch(new DeleteAssetsRequest($body, $options));
    }

    /**
     * Deletes a row from the grid widget and updates host asset: POST /tas/api/assetmgmt/assets/deleteGridFieldAsset.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: assetId, hostAssetId.
     */
    public function deleteGridFieldAsset(array|JsonSerializable $body, array $options = []): ?DeleteGridAssetResponse
    {
        return $this->fetch(new DeleteGridFieldAssetRequest($body, $options));
    }

    /**
     * Returns assets which meet the given criteria. Identical with GET /assets but can handle a longer parameter list:
     * POST /tas/api/assetmgmt/assets/filter.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function filterAssets(array|JsonSerializable $body = [], array $options = []): bool
    {
        return $this->perform(new FilterAssetsRequest($body, $options));
    }

    /**
     * Retrieves an asset based on the given assetId: GET /tas/api/assetmgmt/assets/{assetId}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: includeFunctionalities.
     */
    public function getAsset(int|string $assetId, array $options = []): ?FrontendAsset
    {
        return $this->fetch(new GetAssetRequest($assetId, $options));
    }

    /**
     * Get available actions for the asset: GET /tas/api/assetmgmt/assets/{assetId}/actions.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getAssetActions(int|string $assetId, array $options = []): ?ManualTriggersResponse
    {
        return $this->fetch(new GetAssetActionsRequest($assetId, $options));
    }

    /**
     * Get assignments for asset: GET /tas/api/assetmgmt/assets/{assetId}/assignments.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: includeInherited, limit.
     */
    public function getAssetAssignments(int|string $assetId, array $options = []): ?Links
    {
        return $this->fetch(new GetAssetAssignmentsRequest($assetId, $options));
    }

    /**
     * Retrieves a blank, not-yet-persisted asset based on the given templateId or templateName: GET
     * /tas/api/assetmgmt/assets/blank.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: templateId, templateName.
     */
    public function getAssetBlank(array $options = []): ?FrontendAsset
    {
        return $this->fetch(new GetAssetBlankRequest($options));
    }

    /**
     * Returns list of external links to the specified asset as items: GET
     * /tas/api/assetmgmt/assets/{assetId}/history/currentItems.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: excludedCategories, lastSeen, pageSize, includeAuxiliaryInfo.
     */
    public function getAssetHistoryCurrentItems(int|string $assetId, array $options = []): ?HistoryItemCollection
    {
        return $this->fetch(new GetAssetHistoryCurrentItemsRequest($assetId, $options));
    }

    /**
     * Returns list of items from audit log and optionally from external sources which are related to the specified
     * asset: GET /tas/api/assetmgmt/assets/{assetId}/history/pastItems.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: excludedCategories, lastSeen, pageSize, includeAuxiliaryInfo, includeExternalItems.
     */
    public function getAssetHistoryPastItems(int|string $assetId, array $options = []): ?HistoryItemCollection
    {
        return $this->fetch(new GetAssetHistoryPastItemsRequest($assetId, $options));
    }

    /**
     * Returns assets which meet the given criteria: GET /tas/api/assetmgmt/assets.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Data>
     */
    public function getAssets(): PagedResource
    {
        return new PagedResource($this->connector, null, fn (Query $query) => new GetAssetsRequest($query));
    }

    /**
     * Returns a list of all assets of a given type: GET /tas/api/assetmgmt/assets/templateId/{templateId}.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<AssetData>
     */
    public function getBlankAssetForTemplate(int|string $templateId): PagedResource
    {
        return new PagedResource($this->connector, AssetData::class, fn (Query $query) => new GetBlankAssetForTemplateRequest($templateId, $query));
    }

    /**
     * Retrieves a line of the grid field based on the assetId (of the line) and the hostAssetId (which is the asset
     * the grid field belongs to): GET /tas/api/assetmgmt/assets/gridFieldAsset.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: assetId, hostAssetId.
     */
    public function getGridFieldAsset(array $options = []): ?FrontendAsset
    {
        return $this->fetch(new GetGridFieldAssetRequest($options));
    }

    /**
     * Gets assets of grid field: GET /tas/api/assetmgmt/assets/getGridFieldValues.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Data>
     */
    public function getGridFieldValues(): PagedResource
    {
        return new PagedResource($this->connector, null, fn (Query $query) => new GetGridFieldValuesRequest($query));
    }

    /**
     * Add links between a knowledge item and one or more assets. Linking archived knowledge item is supported: POST
     * /tas/api/assetmgmt/assets/linkedKnowledgeItem.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     * @return Collection<int, LinkResponse>
     */
    public function linkAssetsToKnowledgeItem(array|JsonSerializable $body, array $options = []): Collection
    {
        return $this->fetch(new LinkAssetsToKnowledgeItemRequest($body, $options));
    }

    /**
     * Add links between a service, supplier service and one or more assets: POST
     * /tas/api/assetmgmt/assets/linkedService.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     * @return Collection<int, LinkResponse>
     */
    public function linkAssetsToService(array|JsonSerializable $body, array $options = []): Collection
    {
        return $this->fetch(new LinkAssetsToServiceRequest($body, $options));
    }

    /**
     * Add links between a change, change activity, incident, operational activity, operational series, problem and one
     * or more assets: POST /tas/api/assetmgmt/assets/linkedTask.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     * @return Collection<int, LinkResponse>
     */
    public function linkAssetsToTask(array|JsonSerializable $body, array $options = []): Collection
    {
        return $this->fetch(new LinkAssetsToTaskRequest($body, $options));
    }

    /**
     * Add branch, location, person and person group assignment to a single asset, stock or bulk item: PUT
     * /tas/api/assetmgmt/assets/{assetId}/assignments.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceAssetAssignments(int|string $assetId, array|JsonSerializable $body, array $options = []): ?AssignmentLinkResponse
    {
        return $this->fetch(new ReplaceAssetAssignmentsRequest($assetId, $body, $options));
    }

    /**
     * Assigns branches to an asset: PUT
     * /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/branches.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceAssetBranchesForTemplate(int|string $templateId, int|string $assetId, array|JsonSerializable $body, array $options = []): ?LinkResults
    {
        return $this->fetch(new ReplaceAssetBranchesForTemplateRequest($templateId, $assetId, $body, $options));
    }

    /**
     * Assigns locations to an asset: PUT
     * /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/locations.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceAssetLocationsForTemplate(int|string $templateId, int|string $assetId, array|JsonSerializable $body, array $options = []): ?LinkResults
    {
        return $this->fetch(new ReplaceAssetLocationsForTemplateRequest($templateId, $assetId, $body, $options));
    }

    /**
     * Assigns person groups to an asset: PUT
     * /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/personGroups.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceAssetPersonGroupsForTemplate(int|string $templateId, int|string $assetId, array|JsonSerializable $body, array $options = []): ?LinkResults
    {
        return $this->fetch(new ReplaceAssetPersonGroupsForTemplateRequest($templateId, $assetId, $body, $options));
    }

    /**
     * Assigns persons to an asset: PUT /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}/assignment/persons.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceAssetPersonsForTemplate(int|string $templateId, int|string $assetId, array|JsonSerializable $body, array $options = []): ?LinkResults
    {
        return $this->fetch(new ReplaceAssetPersonsForTemplateRequest($templateId, $assetId, $body, $options));
    }

    /**
     * Unarchives an asset: POST /tas/api/assetmgmt/assets/{assetId}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveAsset(int|string $assetId, array $options = []): ?FrontendAsset
    {
        return $this->fetch(new UnarchiveAssetRequest($assetId, $options));
    }

    /**
     * Delete links between the specified entity and one or more assets: POST
     * /tas/api/assetmgmt/assets/unlink/{type}/{targetId}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unlinkAssets(int|string $type, int|string $targetId, array|JsonSerializable $body = [], array $options = []): ?UnlinkResponse
    {
        return $this->fetch(new UnlinkAssetsRequest($type, $targetId, $body, $options));
    }

    /**
     * Updates an existing asset: POST /tas/api/assetmgmt/assets/{assetId}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateAsset(int|string $assetId, array|JsonSerializable $body, array $options = []): ?FrontendAsset
    {
        return $this->fetch(new UpdateAssetRequest($assetId, $body, $options));
    }

    /**
     * Updates an existing asset: PATCH /tas/api/assetmgmt/assets/templateId/{templateId}/{assetId}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateAssetForTemplate(int|string $templateId, int|string $assetId, array|JsonSerializable $body, array $options = []): ?ModifiedAssetResponse
    {
        return $this->fetch(new UpdateAssetForTemplateRequest($templateId, $assetId, $body, $options));
    }
}
