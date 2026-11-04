<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Data\Assets\HistoryItemCollection;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns list of external links to the specified asset as items: GET
 * /tas/api/assetmgmt/assets/{assetId}/history/currentItems.
 *
 * Read permission is required for the particular asset.
 */
class GetAssetHistoryCurrentItemsRequest extends GetRequest
{
    protected ?string $dto = HistoryItemCollection::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: excludedCategories, lastSeen, pageSize, includeAuxiliaryInfo.
     */
    public function __construct(protected int|string $assetId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/'.Path::segment((string) $this->assetId).'/history/currentItems';
    }
}
