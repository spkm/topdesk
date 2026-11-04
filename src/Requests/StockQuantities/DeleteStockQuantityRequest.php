<?php

namespace spkm\Topdesk\Requests\StockQuantities;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Removes the link between a bulk item and a stock: DELETE /tas/api/assetmgmt/stockQuantities/{id}.
 */
class DeleteStockQuantityRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/stockQuantities/'.Path::segment((string) $this->id);
    }
}
