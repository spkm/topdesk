<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\FrontendAsset;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archives an asset: POST /tas/api/assetmgmt/assets/{assetId}/archive.
 *
 * Archives the asset identified by the provided ID (assetId). To archive an asset you need to provide a reason for
 * archiving (reasonId) in the body. The endpoint for retrieving the available reasons can be found in the General API.
 */
class ArchiveAssetRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = FrontendAsset::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $assetId, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/'.Path::segment((string) $this->assetId).'/archive';
    }
}
