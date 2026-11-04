<?php

namespace spkm\Topdesk\Requests\KnowledgeBaseExplorer;

use spkm\Topdesk\Data\KnowledgeBase\FolderReference;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the reference of the folder created from the knowledge identifier: GET
 * /services/knowledge-base-v1/explorer/migrated/folder/{identifier}.
 *
 * Returns the identifier and number of the folder created during the Explorer Migration from the provided knowledge
 * item. This only gives results for knowledge items that used to be a parent item in the old explorer. If a knowledge
 * item has been deleted, you will not be able to find the folder using the knowledge item number.
 */
class GetExplorerMigratedFolderRequest extends GetRequest
{
    protected ?string $dto = FolderReference::class;

    protected ?string $accept = 'application/x.topdesk-kb-explorer-migrated-folder-v1+json';

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/explorer/migrated/folder/'.Path::segment((string) $this->identifier);
    }
}
