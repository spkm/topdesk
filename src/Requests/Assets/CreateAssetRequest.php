<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\FrontendAsset;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Creates a new asset: POST /tas/api/assetmgmt/assets.
 *
 * Creates a new asset. To create a new asset, you will need the type of the asset you want to create (type_id), and to
 * fill in the values of the mandatory fields of that specific asset type/template. You can get the ID of the available
 * types of assets/templates using the /assetmgmt/templates endpoint. In order to get the fields of an asset, you can
 * use the /assetmgmt/assets/blank endpoint.
 */
class CreateAssetRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = FrontendAsset::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets';
    }
}
