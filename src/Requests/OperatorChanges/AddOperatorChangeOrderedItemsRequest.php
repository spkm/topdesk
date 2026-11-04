<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Order items for a change: POST /tas/api/operatorChanges/{id}/orderedItems.
 *
 * Note: This endpoint is only available if you have the webshop licence.
 */
class AddOperatorChangeOrderedItemsRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    protected bool $listBody = true;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The list TOPdesk takes.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->id).'/orderedItems';
    }
}
