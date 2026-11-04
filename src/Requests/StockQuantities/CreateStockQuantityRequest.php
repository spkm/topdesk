<?php

namespace spkm\Topdesk\Requests\StockQuantities;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\StockQuantitiesItem;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Links a bulk item to a stock: POST /tas/api/assetmgmt/stockQuantities.
 *
 * Links a bulk item to a stock with the specified initial quantity.
 */
class CreateStockQuantityRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = StockQuantitiesItem::class;

    protected ?string $accept = 'application/x.topdesk-am-stock-quantity-v0+json';

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/stockQuantities';
    }
}
