<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Data\Assets\FrontendAsset;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Retrieves a line of the grid field based on the assetId (of the line) and the hostAssetId (which is the asset the
 * grid field belongs to): GET /tas/api/assetmgmt/assets/gridFieldAsset.
 */
class GetGridFieldAssetRequest extends GetRequest
{
    protected ?string $dto = FrontendAsset::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: assetId, hostAssetId.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/gridFieldAsset';
    }
}
