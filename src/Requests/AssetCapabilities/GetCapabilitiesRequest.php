<?php

namespace spkm\Topdesk\Requests\AssetCapabilities;

use spkm\Topdesk\Data\Assets\DataSetItem;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns list of all link types: GET /tas/api/assetmgmt/capabilities.
 */
class GetCapabilitiesRequest extends ListRequest
{
    protected ?string $dto = DataSetItem::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/capabilities';
    }
}
