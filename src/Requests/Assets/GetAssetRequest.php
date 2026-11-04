<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Data\Assets\FrontendAsset;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Retrieves an asset based on the given assetId: GET /tas/api/assetmgmt/assets/{assetId}.
 */
class GetAssetRequest extends GetRequest
{
    protected ?string $dto = FrontendAsset::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: includeFunctionalities.
     */
    public function __construct(protected int|string $assetId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/'.Path::segment((string) $this->assetId);
    }
}
