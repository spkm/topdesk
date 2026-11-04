<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\FrontendAsset;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Updates an existing row: POST /tas/api/assetmgmt/assets/gridFieldAsset.
 */
class CreateGridFieldAssetRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = FrontendAsset::class;

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
        return '/tas/api/assetmgmt/assets/gridFieldAsset';
    }
}
