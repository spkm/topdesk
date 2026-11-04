<?php

namespace spkm\Topdesk\Requests\KnowledgeFolders;

use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unarchives the Folder: POST /services/knowledge-base-v1/folders/{identifier}/unarchive.
 *
 * Unarchives the Folder with the given identifier and all its children and further descendents. The Folder can only be
 * unarchived if the parent item is not archived. If the Folder is already unarchived nothing will change. It is
 * necessary to have the permission to update and archive Knowledge Items.
 */
class UnarchiveFolderRequest extends ActionRequest
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
        return '/services/knowledge-base-v1/folders/'.Path::segment((string) $this->identifier).'/unarchive';
    }
}
