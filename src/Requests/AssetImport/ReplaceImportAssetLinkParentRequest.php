<?php

namespace spkm\Topdesk\Requests\AssetImport;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Assets\LinkResults;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Sets the parents of an asset: PUT /tas/api/assetmgmt/import/assets/{assetId}/links/parent.
 *
 * Sets the parents of an asset. The request body contains a list of IDs of assets that should be parents of the asset.
 * The following rules apply: This operation is only available for active assets with a relationships widget. The
 * specified list of assets represents the desired list of linked parents. Assets in the list that were not yet linked
 * to the asset as parents, will be linked.
 */
class ReplaceImportAssetLinkParentRequest extends WriteRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = LinkResults::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $assetId, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/import/assets/'.Path::segment((string) $this->assetId).'/links/parent';
    }
}
