<?php

namespace spkm\Topdesk\Requests\RequesterChanges;

use spkm\Topdesk\Data\Changes\OrderedItem;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Lists the ordered items for this change: GET /tas/api/requesterChanges/{id}/orderedItems.
 */
class GetRequesterChangeOrderedItemsRequest extends ListRequest
{
    protected ?string $dto = OrderedItem::class;

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
        return '/tas/api/requesterChanges/'.Path::segment((string) $this->id).'/orderedItems';
    }
}
