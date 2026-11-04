<?php

namespace spkm\Topdesk\Requests\Badges;

use spkm\Topdesk\Data\Visitors\FullSearchlistDto;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Get badges: GET /tas/api/badges.
 */
class GetBadgesRequest extends ListRequest
{
    protected ?string $dto = FullSearchlistDto::class;

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: archived.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/badges';
    }
}
