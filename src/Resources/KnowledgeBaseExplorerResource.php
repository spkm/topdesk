<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Data\KnowledgeBase\ExplorerMigrated;
use spkm\Topdesk\Data\KnowledgeBase\FolderReference;
use spkm\Topdesk\Requests\KnowledgeBaseExplorer\GetExplorerMigratedFolderRequest;
use spkm\Topdesk\Requests\KnowledgeBaseExplorer\GetExplorerMigratedRequest;

/**
 * The knowledge base explorer endpoints of TOPdesk's Knowledge Base API, from Topdesk::knowledgeBaseExplorer().
 *
 * @extends BaseResource<Data>
 */
class KnowledgeBaseExplorerResource extends BaseResource
{
    /**
     * Returns if the explorer is migrated: GET /services/knowledge-base-v1/explorer/migrated.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getExplorerMigrated(array $options = []): ?ExplorerMigrated
    {
        return $this->fetch(new GetExplorerMigratedRequest($options));
    }

    /**
     * Returns the reference of the folder created from the knowledge identifier: GET
     * /services/knowledge-base-v1/explorer/migrated/folder/{identifier}.
     *
     * @param  array<string, mixed>  $options  Query options.
     */
    public function getExplorerMigratedFolder(int|string $identifier, array $options = []): ?FolderReference
    {
        return $this->fetch(new GetExplorerMigratedFolderRequest($identifier, $options));
    }
}
