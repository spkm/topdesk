<?php

namespace spkm\Topdesk\Requests\KnowledgeBaseExplorer;

use spkm\Topdesk\Data\KnowledgeBase\ExplorerMigrated;
use spkm\Topdesk\Requests\GetRequest;

/**
 * Returns if the explorer is migrated: GET /services/knowledge-base-v1/explorer/migrated.
 *
 * Returns if the explorer is migrated or not. This endpoint can be used until 31st of December 2026 to determine which
 * API to use.
 */
class GetExplorerMigratedRequest extends GetRequest
{
    protected ?string $dto = ExplorerMigrated::class;

    protected ?string $accept = 'application/x.topdesk-kb-explorer-migrated-v1+json';

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/explorer/migrated';
    }
}
