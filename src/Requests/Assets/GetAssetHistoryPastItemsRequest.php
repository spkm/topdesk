<?php

namespace spkm\Topdesk\Requests\Assets;

use spkm\Topdesk\Data\Assets\HistoryItemCollection;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns list of items from audit log and optionally from external sources which are related to the specified asset:
 * GET /tas/api/assetmgmt/assets/{assetId}/history/pastItems.
 *
 * Read permission is required for the particular asset.
 */
class GetAssetHistoryPastItemsRequest extends GetRequest
{
    protected ?string $dto = HistoryItemCollection::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: excludedCategories, lastSeen, pageSize, includeAuxiliaryInfo, includeExternalItems.
     */
    public function __construct(protected int|string $assetId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assets/'.Path::segment((string) $this->assetId).'/history/pastItems';
    }
}
