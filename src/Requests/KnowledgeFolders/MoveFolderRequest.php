<?php

namespace spkm\Topdesk\Requests\KnowledgeFolders;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Moves the Folder under a different parent Folder: POST /services/knowledge-base-v1/folders/{identifier}/move.
 *
 * Moves the Folder with the given identifier to the specified parent Folder. It is necessary to have the permission to
 * update Knowledge Items.
 */
class MoveFolderRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    protected ?string $contentType = 'application/x.topdesk-kb-move-folder-v1+json';

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
        return '/services/knowledge-base-v1/folders/'.Path::segment((string) $this->identifier).'/move';
    }
}
