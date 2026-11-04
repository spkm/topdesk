<?php

namespace spkm\Topdesk\Requests\KnowledgeFolders;

use spkm\Topdesk\Data\KnowledgeBase\Folder;
use spkm\Topdesk\Query\Query;
use spkm\Topdesk\Requests\ListRequest;

/**
 * Returns a list of Folders: GET /services/knowledge-base-v1/folders.
 *
 * Returns a list of Folders, satisfying a given query. When called without any parameters, this endpoint will return
 * the first 100 Folders, sorted by the Folder number, smallest first. Only the Folders which have content in the
 * requested language will be listed. It is necessary to have the permission to read Knowledge Items.
 */
class GetFoldersRequest extends ListRequest
{
    protected ?string $dto = Folder::class;

    protected ?string $accept = 'application/x.topdesk-kb-folder-list-v1+json';

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
        return '/services/knowledge-base-v1/folders';
    }
}
