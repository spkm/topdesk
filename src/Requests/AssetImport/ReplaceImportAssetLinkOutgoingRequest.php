<?php

namespace spkm\Topdesk\Requests\AssetImport;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Assets\LinkResults;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Sets an asset's provided links according to a specific link type: PUT
 * /tas/api/assetmgmt/import/assets/{assetId}/links/outgoing/{linkTypeId}.
 *
 * Sets an asset's provided links according to a specific link type.The request body contains a list of IDs of assets
 * that should be linked to the asset. The following rules apply: This operation is only available for active assets
 * with a relationships widget that provide the specified link type.
 */
class ReplaceImportAssetLinkOutgoingRequest extends WriteRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = LinkResults::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $assetId, protected int|string $linkTypeId, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/import/assets/'.Path::segment((string) $this->assetId).'/links/outgoing/'.Path::segment((string) $this->linkTypeId);
    }
}
