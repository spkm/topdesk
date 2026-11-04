<?php

namespace spkm\Topdesk\Requests\AssetLinks;

use spkm\Topdesk\Data\Assets\LinkedAsset;
use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Remove link between two assets: DELETE /tas/api/assetmgmt/assetLinks/{relationId}.
 */
class DeleteAssetLinkRequest extends DeleteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = LinkedAsset::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $relationId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assetLinks/'.Path::segment((string) $this->relationId);
    }
}
