<?php

namespace spkm\Topdesk\Requests\AssetImport;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Assets\LinkResults;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Sets the children of an asset: PUT /tas/api/assetmgmt/import/assets/{assetId}/links/child.
 *
 * Sets the children of an asset. The request body contains a list of IDs of assets that should be children of the
 * asset. The following rules apply: This operation is only available for active assets with a relationships widget.
 * The specified list of assets represents the desired list of linked children. Assets in the list that were not yet
 * linked to the asset as children, will be linked.
 */
class ReplaceImportAssetLinkChildRequest extends WriteRequest
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
        return '/tas/api/assetmgmt/import/assets/'.Path::segment((string) $this->assetId).'/links/child';
    }
}
