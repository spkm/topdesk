<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\LinkedAsset;
use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\AssetLinks\CreateAssetLinkRequest;
use spkm\Topdesk\Requests\AssetLinks\DeleteAssetLinkRequest;
use spkm\Topdesk\Requests\AssetLinks\GetAssetLinkPossibleRelationsRequest;
use spkm\Topdesk\Requests\AssetLinks\GetAssetLinksRequest;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The asset links endpoints of TOPdesk's Asset Management API, from Topdesk::assetLinks().
 *
 * @extends Builder<LinkedAsset>
 */
class AssetLinksResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, LinkedAsset::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetAssetLinksRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateAssetLinkRequest($body);
    }

    protected function deleteRequest(int|string $id): TopdeskRequest
    {
        return new DeleteAssetLinkRequest($id);
    }

    /**
     * Link asset to target asset: POST /tas/api/assetmgmt/assetLinks.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createAssetLink(array|JsonSerializable $body, array $options = []): ?LinkedAsset
    {
        return $this->fetch(new CreateAssetLinkRequest($body, $options));
    }

    /**
     * Remove link between two assets: DELETE /tas/api/assetmgmt/assetLinks/{relationId}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteAssetLink(int|string $relationId, array $options = []): ?LinkedAsset
    {
        return $this->fetch(new DeleteAssetLinkRequest($relationId, $options));
    }

    /**
     * Return the list of possible relations between source and target asset: GET
     * /tas/api/assetmgmt/assetLinks/possibleRelations.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<Data>
     */
    public function getAssetLinkPossibleRelations(): PagedResource
    {
        return new PagedResource($this->connector, null, fn (Query $query) => new GetAssetLinkPossibleRelationsRequest($query));
    }

    /**
     * Return linked assets: GET /tas/api/assetmgmt/assetLinks.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<LinkedAsset>
     */
    public function getAssetLinks(): PagedResource
    {
        return new PagedResource($this->connector, LinkedAsset::class, fn (Query $query) => new GetAssetLinksRequest($query));
    }
}
