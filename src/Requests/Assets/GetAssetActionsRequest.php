<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Data\Assets\ManualTriggersResponse;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get available actions for the asset: GET /tas/api/assetmgmt/assets/{assetId}/actions.
 */
class GetAssetActionsRequest extends GetRequest
{
    protected ?string $dto = ManualTriggersResponse::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $assetId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/'.Path::segment((string) $this->assetId).'/actions';
    }
}
