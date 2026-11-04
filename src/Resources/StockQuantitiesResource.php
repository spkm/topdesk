<?php

namespace spkm\Topdesk\Resources;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\StockQuantitiesItem;
use spkm\Topdesk\Query\Builder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Requests\StockQuantities\CreateStockQuantityRequest;
use spkm\Topdesk\Requests\StockQuantities\DeleteStockQuantityRequest;
use spkm\Topdesk\Requests\StockQuantities\GetStockQuantitiesRequest;
use spkm\Topdesk\Requests\StockQuantities\ReplaceStockQuantityRequest;
use spkm\Topdesk\Requests\TopdeskRequest;
use spkm\Topdesk\TopdeskConnector;

/**
 * The stock quantities endpoints of TOPdesk's Asset Management API, from Topdesk::stockQuantities().
 *
 * @extends Builder<StockQuantitiesItem>
 */
class StockQuantitiesResource extends Builder
{
    public function __construct(TopdeskConnector $connector)
    {
        parent::__construct($connector, StockQuantitiesItem::class);
    }

    protected function listRequest(Query $query): ListRequest
    {
        return new GetStockQuantitiesRequest($query);
    }

    protected function createRequest(array $body): TopdeskRequest
    {
        return new CreateStockQuantityRequest($body);
    }

    protected function updateRequest(int|string $id, array $body): TopdeskRequest
    {
        return new ReplaceStockQuantityRequest($id, $body);
    }

    protected function deleteRequest(int|string $id): TopdeskRequest
    {
        return new DeleteStockQuantityRequest($id);
    }

    /**
     * Links a bulk item to a stock: POST /tas/api/assetmgmt/stockQuantities.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function createStockQuantity(array|JsonSerializable $body, array $options = []): ?StockQuantitiesItem
    {
        return $this->fetch(new CreateStockQuantityRequest($body, $options));
    }

    /**
     * Removes the link between a bulk item and a stock: DELETE /tas/api/assetmgmt/stockQuantities/{id}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function deleteStockQuantity(int|string $id, array $options = []): bool
    {
        return $this->perform(new DeleteStockQuantityRequest($id, $options));
    }

    /**
     * Queries stock quantities for either a bulk item or a stock: GET /tas/api/assetmgmt/stockQuantities.
     *
     * A builder over the list: where(), select(), orderBy(), get(), lazy() and the rest, as far as the endpoint takes
     * them.
     *
     * @return PagedResource<StockQuantitiesItem>
     */
    public function getStockQuantities(): PagedResource
    {
        return new PagedResource($this->connector, StockQuantitiesItem::class, fn (Query $query) => new GetStockQuantitiesRequest($query));
    }

    /**
     * Edits bulk item quantity on a stock: PUT /tas/api/assetmgmt/stockQuantities/{id}.
     *
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function replaceStockQuantity(int|string $id, array|JsonSerializable $body, array $options = []): ?StockQuantitiesItem
    {
        return $this->fetch(new ReplaceStockQuantityRequest($id, $body, $options));
    }
}
