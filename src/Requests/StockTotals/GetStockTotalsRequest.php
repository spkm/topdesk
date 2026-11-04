<?php

namespace spkm\Topdesk\Requests\StockTotals;

use spkm\Topdesk\Data\Assets\LinkStatisticsItem;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns information about what is in stock: GET /tas/api/assetmgmt/stockTotals.
 *
 * Returns which asset type is in how many stocks and how many instances of each particular asset type is in stock.
 * Similarly, it also returns which bulk item is in how many stocks and what is the total quantity of each particular
 * bulk item in stock.
 */
class GetStockTotalsRequest extends ListRequest
{
    protected ?string $dto = LinkStatisticsItem::class;

    protected ?string $accept = 'application/x.topdesk-am-link-statistics-v0+json';

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
        return '/tas/api/assetmgmt/stockTotals';
    }
}
