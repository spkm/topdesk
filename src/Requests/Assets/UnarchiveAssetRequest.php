<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Data\Assets\FrontendAsset;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchives an asset: POST /tas/api/assetmgmt/assets/{assetId}/unarchive.
 */
class UnarchiveAssetRequest extends ActionRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = FrontendAsset::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $assetId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/'.Path::segment((string) $this->assetId).'/unarchive';
    }
}
