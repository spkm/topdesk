<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\DeleteGridAssetResponse;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Deletes a row from the grid widget and updates host asset: POST /tas/api/assetmgmt/assets/deleteGridFieldAsset.
 *
 * This operation changes the etag-value of the host asset which contains the dataset.The new etag is sent back in the
 * response as the etag property. In subsequent calls the newly received etag should be used.
 */
class DeleteGridFieldAssetRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = DeleteGridAssetResponse::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: assetId, hostAssetId.
     */
    public function __construct(array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/deleteGridFieldAsset';
    }
}
