<?php

namespace spkm\Topdesk\Requests\KnowledgeFolders;

use spkm\Topdesk\Data\KnowledgeBase\BranchReference;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns all linked branches of the Folder: GET /services/knowledge-base-v1/folders/{identifier}/branches.
 *
 * Returns all linked branches of the Folder with the given identifier. It is necessary to have the permission to
 * update Knowledge Items and the permission to read branches. Because of the needed permission to update Knowledge
 * Items, the branch filters do not apply on the individual folder level, however the returned branches from this
 * endpoint are still limited to the ones visible to the operator.
 */
class GetFolderBranchesRequest extends ListRequest
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
        return '/services/knowledge-base-v1/folders/'.Path::segment((string) $this->identifier).'/branches';
    }
}
