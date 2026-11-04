<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Data\KnowledgeBase\KnowledgeItem;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of Knowledge Items: GET /services/knowledge-base-v1/knowledgeItems.
 *
 * Returns a list of Knowledge Items, satisfying a given query. When called without any parameters, this endpoint will
 * return the first 100 Knowledge Items, sorted by the Knowledge Item number, smallest first. Only the Knowledge Items
 * which have content in the requested language will be listed. It is necessary to have the permission to read
 * Knowledge Items.
 */
class GetKnowledgeItemsRequest extends ListRequest
{
    protected ?string $dto = KnowledgeItem::class;

    protected ?string $accept = 'application/x.topdesk-kb-ki-list-v1+json';

    protected ?string $filterParameter = 'query';

    protected ?string $fieldsParameter = 'fields';

    protected ?string $offsetParameter = 'start';

    protected ?string $sizeParameter = 'page_size';

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array. Other parameters TOPdesk documents: language.
     */
    public function __construct(Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems';
    }
}
