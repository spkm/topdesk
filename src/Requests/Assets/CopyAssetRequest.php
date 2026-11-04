<?php

namespace spkm\Topdesk\Requests\Assets;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\CopyAssetResponseList;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Copies an asset: POST /tas/api/assetmgmt/assets/{assetId}/copy.
 *
 * It is only available for active assets. The mandatory fields are dependent on the auto numbering settings of the
 * source asset's template. If it is enabled only the numberOfCopies should be provided. Otherwise prefix and start at
 * are also mandatory.
 */
class CopyAssetRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = CopyAssetResponseList::class;

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
        return '/tas/api/assetmgmt/assets/'.Path::segment((string) $this->assetId).'/copy';
    }
}
