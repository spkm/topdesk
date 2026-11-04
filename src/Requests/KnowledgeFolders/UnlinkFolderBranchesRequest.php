<?php

namespace spkm\Topdesk\Requests\KnowledgeFolders;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Unlinks a branch from the Folder: POST /services/knowledge-base-v1/folders/{identifier}/branches/unlink.
 *
 * Unlinks the specified branch from the Folder with the given identifier. Only branches that are visible to the
 * operator can be unlinked. Note that it takes up to 5 minutes for the change to become effective. It is necessary to
 * have the permission to update Knowledge Items and the permission to read branches.
 */
class UnlinkFolderBranchesRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    protected ?string $contentType = 'application/x.topdesk-kb-unlink-folder-branch-v1+json';

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/folders/'.Path::segment((string) $this->identifier).'/branches/unlink';
    }
}
