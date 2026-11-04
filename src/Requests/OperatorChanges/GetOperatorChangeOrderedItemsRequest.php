<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use spkm\Topdesk\Data\Changes\OrderedItemResultDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * List of ordered items: GET /tas/api/operatorChanges/{id}/orderedItems.
 *
 * Note: This endpoint is only available if you have the webshop licence.
 */
class GetOperatorChangeOrderedItemsRequest extends ListRequest
{
    protected ?string $dto = OrderedItemResultDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(protected int|string $id, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->id).'/orderedItems';
    }
}
