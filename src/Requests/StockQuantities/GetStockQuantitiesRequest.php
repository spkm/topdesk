<?php

namespace spkm\Topdesk\Requests\StockQuantities;

use spkm\Topdesk\Data\Assets\StockQuantitiesItem;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Queries stock quantities for either a bulk item or a stock: GET /tas/api/assetmgmt/stockQuantities.
 *
 * Queries all stocks linked to the bulk item specified using bulkItemId along with the quantity for each stock. When
 * using stockId, the result of the query contains all bulk items linked to the specified stock along with the quantity
 * for each bulk item.
 */
class GetStockQuantitiesRequest extends ListRequest
{
    protected ?string $dto = StockQuantitiesItem::class;

    protected ?string $accept = 'application/x.topdesk-am-stock-quantities-v0+json';

    protected ?string $sizeParameter = 'pageSize';

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: stockId, bulkItemId, lastSeenName.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/stockQuantities';
    }
}
