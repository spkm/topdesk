<?php

namespace spkm\Topdesk\Requests\AssetLinks;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\LinkedAsset;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Link asset to target asset: POST /tas/api/assetmgmt/assetLinks.
 *
 * Creates a link between two assets. These links are often referred to as 'relationships'.
 */
class CreateAssetLinkRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = LinkedAsset::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assetLinks';
    }
}
