<?php

namespace spkm\Topdesk\Requests\KnowledgeItemStatuses;

use spkm\Topdesk\Data\KnowledgeBase\Searchlist;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns Knowledge Item statuses: GET /services/knowledge-base-v1/knowledgeItemStatuses.
 *
 * Returns the list of possible Knowledge Item statuses. It is required to have create or update permissions on
 * knowledge items, or read permission on knowledge base settings to use this endpoint
 */
class GetKnowledgeItemStatusesRequest extends ListRequest
{
    protected ?string $dto = Searchlist::class;

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
        return '/services/knowledge-base-v1/knowledgeItemStatuses';
    }
}
