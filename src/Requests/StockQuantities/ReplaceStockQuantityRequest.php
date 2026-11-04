<?php

namespace spkm\Topdesk\Requests\StockQuantities;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Data\Assets\StockQuantitiesItem;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Edits bulk item quantity on a stock: PUT /tas/api/assetmgmt/stockQuantities/{id}.
 *
 * Edits quantity of how much bulk item is available on a given stock.
 */
class ReplaceStockQuantityRequest extends WriteRequest
{
    protected Method $method = Method::PUT;

    protected string $responseShape = self::ONE;

    protected ?string $dto = StockQuantitiesItem::class;

    protected ?string $accept = 'application/x.topdesk-am-stock-quantity-v0+json';

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/stockQuantities/'.Path::segment((string) $this->id);
    }
}
