<?php

namespace spkm\Topdesk\Requests\AssetLinks;

use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Return the list of possible relations between source and target asset: GET
 * /tas/api/assetmgmt/assetLinks/possibleRelations.
 *
 * Returns the available relationship types (child, parent and available link type IDs) for two assets (sourceId,
 * targetId).
 */
class GetAssetLinkPossibleRelationsRequest extends ListRequest
{
    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: sourceId, targetId.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/assetLinks/possibleRelations';
    }
}
