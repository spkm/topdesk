<?php

namespace spkm\Topdesk\Requests\KnowledgeFolders;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archives the Folder: POST /services/knowledge-base-v1/folders/{identifier}/archive.
 *
 * Archives the Folder with the given identifier and all its children and further descendents. If the Folder is already
 * archived nothing will change. It is necessary to have the permission to update and archive Knowledge Items.
 */
class ArchiveFolderRequest extends ActionRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/folders/'.Path::segment((string) $this->identifier).'/archive';
    }
}
