<?php

namespace spkm\Topdesk\Requests\KnowledgeFolders;

use JsonSerializable;
use spkm\Topdesk\Data\KnowledgeBase\Reference;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Creates a Folder with given content: POST /services/knowledge-base-v1/folders.
 *
 * Creates a Folder with given content. Optionally, if the parent is provided, the new Folder will be a child of this
 * Folder. Otherwise, it will be created on the top level. It is necessary to have the permission to create Knowledge
 * Items. In order for an operator / operator group to be assigned as manager, the "Knowledge Base Manager" task must
 * be selected in the Supporting Files module.
 */
class CreateFolderRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = Reference::class;

    protected ?string $accept = 'application/x.topdesk-kb-folder-created-v1+json';

    protected ?string $contentType = 'application/x.topdesk-kb-create-folder-v1+json';

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/folders';
    }
}
