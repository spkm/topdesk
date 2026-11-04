<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\CapabilityDto;
use spkm\Topdesk\Data\Assets\DataSetItem;
use spkm\Topdesk\Data\Assets\FrontendCapability;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\AssetCapabilities\ArchiveCapabilityRequest;
use spkm\Topdesk\Requests\AssetCapabilities\CreateCapabilityRequest;
use spkm\Topdesk\Requests\AssetCapabilities\DeleteCapabilityRequest;
use spkm\Topdesk\Requests\AssetCapabilities\GetCapabilitiesRequest;
use spkm\Topdesk\Requests\AssetCapabilities\GetCapabilityRequest;
use spkm\Topdesk\Requests\AssetCapabilities\UnarchiveCapabilityRequest;
use spkm\Topdesk\Requests\AssetCapabilities\UpdateCapabilityRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The asset capabilities endpoints of TOPdesk's Asset Management API, from Topdesk::assetCapabilities().
 *
 * @extends Builder<DataSetItem>
 */
class AssetCapabilitiesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, DataSetItem::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetCapabilitiesRequest($query);
    }

    protected function itemRequest(int|string $id): TopdeskRequest
    {
        return new GetCapabilityRequest($id);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateCapabilityRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new UpdateCapabilityRequest($id, $body);
    }

    protected function deleteRequest(int|string $id): TopdeskRequest
    {
        return new DeleteCapabilityRequest($id);
    }

    /**
     * Archives a link type: POST /tas/api/assetmgmt/capabilities/{capabilityId}/archive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function archiveCapability(int|string $capabilityId, array $options = []): ?CapabilityDto
    {
        return $this->fetch(new ArchiveCapabilityRequest($capabilityId, $options));
    }

    /**
     * Creates a new link type: POST /tas/api/assetmgmt/capabilities.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createCapability(array|JsonSerializable $body, array $options = []): ?CapabilityDto
    {
        return $this->fetch(new CreateCapabilityRequest($body, $options));
    }

    /**
     * Deletes a link type: DELETE /tas/api/assetmgmt/capabilities/{capabilityId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteCapability(int|string $capabilityId, array $options = []): bool
    {
        return $this->perform(new DeleteCapabilityRequest($capabilityId, $options));
    }

    /**
     * Returns list of all link types: GET /tas/api/assetmgmt/capabilities.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<DataSetItem>
     */
    public function getCapabilities(): PagedResource
    {
        return new PagedResource($this->connector, DataSetItem::class, fn (Query $query) => new GetCapabilitiesRequest($query));
    }

    /**
     * Returns the link type with the ID specified in the path: GET /tas/api/assetmgmt/capabilities/{capabilityId}.
     *
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: includeUsage.
     */
    public function getCapability(int|string $capabilityId, array $options = []): ?FrontendCapability
    {
        return $this->fetch(new GetCapabilityRequest($capabilityId, $options));
    }

    /**
     * Unarchives a link type: POST /tas/api/assetmgmt/capabilities/{capabilityId}/unarchive.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function unarchiveCapability(int|string $capabilityId, array $options = []): ?CapabilityDto
    {
        return $this->fetch(new UnarchiveCapabilityRequest($capabilityId, $options));
    }

    /**
     * Updates the name or inheritance status of an existing link type: POST
     * /tas/api/assetmgmt/capabilities/{capabilityId}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function updateCapability(int|string $capabilityId, array|JsonSerializable $body, array $options = []): ?CapabilityDto
    {
        return $this->fetch(new UpdateCapabilityRequest($capabilityId, $body, $options));
    }
}
