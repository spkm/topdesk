<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Assets\LinkStatisticsItem;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\StockTotals\GetStockTotalsRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The stock totals endpoints of TOPdesk's Asset Management API, from Topdesk::stockTotals().
 *
 * @extends Builder<LinkStatisticsItem>
 */
class StockTotalsResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, LinkStatisticsItem::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetStockTotalsRequest($query);
    }

    /**
     * Returns information about what is in stock: GET /tas/api/assetmgmt/stockTotals.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<LinkStatisticsItem>
     */
    public function getStockTotals(): PagedResource
    {
        return new PagedResource($this->connector, LinkStatisticsItem::class, fn (Query $query) => new GetStockTotalsRequest($query));
    }
}
