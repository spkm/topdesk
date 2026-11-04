<?php

namespace spkm\Topdesk\Requests\KnowledgeFolders;

use spkm\Topdesk\Data\KnowledgeBase\Folder;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the Folder by id or number: GET /services/knowledge-base-v1/folders/{identifier}.
 *
 * Returns the Folder with the given identifier. By default, this endpoint will only return the Folder which has
 * content in the requested language. It is necessary to have the permission to read Knowledge Items. If additionally
 * the permission to update Knowledge Items is present, then branch filters do not apply.
 */
class GetFolderRequest extends GetRequest
{
    protected ?string $dto = Folder::class;

    protected ?string $accept = 'application/x.topdesk-kb-folder-v1+json';

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: fields, language.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/folders/'.Path::segment((string) $this->identifier);
    }
}
