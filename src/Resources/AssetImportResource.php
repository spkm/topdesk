<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\AssetData;
use spkm\Topdesk\Data\Assets\LinkResults;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\AssetImport\GetImportAssetsRequest;
use spkm\Topdesk\Requests\AssetImport\ReplaceImportAssetLinkChildRequest;
use spkm\Topdesk\Requests\AssetImport\ReplaceImportAssetLinkIncomingRequest;
use spkm\Topdesk\Requests\AssetImport\ReplaceImportAssetLinkOutgoingRequest;
use spkm\Topdesk\Requests\AssetImport\ReplaceImportAssetLinkParentRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The asset import endpoints of TOPdesk's Asset Management API, from Topdesk::assetImport().
 *
 * @extends Builder<AssetData>
 */
class AssetImportResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, AssetData::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetImportAssetsRequest($query);
    }

    /**
     * Returns a list of all non-archived assets: GET /tas/api/assetmgmt/import/assets.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<AssetData>
     */
    public function getImportAssets(): PagedResource
    {
        return new PagedResource($this->connector, AssetData::class, fn (Query $query) => new GetImportAssetsRequest($query));
    }

    /**
     * Sets the children of an asset: PUT /tas/api/assetmgmt/import/assets/{assetId}/links/child.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceImportAssetLinkChild(int|string $assetId, array|JsonSerializable $body = [], array $options = []): ?LinkResults
    {
        return $this->fetch(new ReplaceImportAssetLinkChildRequest($assetId, $body, $options));
    }

    /**
     * Sets an asset's dependencies according to a specific link type: PUT
     * /tas/api/assetmgmt/import/assets/{assetId}/links/incoming/{linkTypeId}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceImportAssetLinkIncoming(int|string $assetId, int|string $linkTypeId, array|JsonSerializable $body = [], array $options = []): ?LinkResults
    {
        return $this->fetch(new ReplaceImportAssetLinkIncomingRequest($assetId, $linkTypeId, $body, $options));
    }

    /**
     * Sets an asset's provided links according to a specific link type: PUT
     * /tas/api/assetmgmt/import/assets/{assetId}/links/outgoing/{linkTypeId}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceImportAssetLinkOutgoing(int|string $assetId, int|string $linkTypeId, array|JsonSerializable $body = [], array $options = []): ?LinkResults
    {
        return $this->fetch(new ReplaceImportAssetLinkOutgoingRequest($assetId, $linkTypeId, $body, $options));
    }

    /**
     * Sets the parents of an asset: PUT /tas/api/assetmgmt/import/assets/{assetId}/links/parent.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceImportAssetLinkParent(int|string $assetId, array|JsonSerializable $body = [], array $options = []): ?LinkResults
    {
        return $this->fetch(new ReplaceImportAssetLinkParentRequest($assetId, $body, $options));
    }
}
