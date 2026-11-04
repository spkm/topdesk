<?php

namespace spkm\Topdesk\Requests\AssetLinks;

use spkm\Topdesk\Data\Assets\LinkedAsset;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Return linked assets: GET /tas/api/assetmgmt/assetLinks.
 *
 * Returns a list of assets that are linked to the specified asset provided as a parameter (sourceId). When sourceId
 * and targetId are both provided then the direction of the link is also matched.
 */
class GetAssetLinksRequest extends ListRequest
{
    protected ?string $dto = LinkedAsset::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: sourceId, targetId, capabilityId.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assetLinks';
    }
}
