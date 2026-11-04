<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Data\KnowledgeBase\BranchReference;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns all linked branches of the Knowledge Item: GET
 * /services/knowledge-base-v1/knowledgeItems/{identifier}/branches.
 *
 * Returns all linked branches of the Knowledge Item with the given identifier. It is necessary to have the permission
 * to update Knowledge Items and the permission to read branches.
 */
class GetKnowledgeItemBranchesRequest extends ListRequest
{
    protected ?string $dto = BranchReference::class;

    protected ?string $accept = 'application/x.topdesk-kb-branch-list-v1+json';

    protected ?int $maxPageSize = null;

    /**
     * @param  Query|array<string, mixed>  $query  The filter, fields, sort and paging, or the query parameters as an array.
     */
    public function __construct(protected int|string $identifier, Query|array $query = [])
    {
        parent::__construct($query);
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/branches';
    }
}
