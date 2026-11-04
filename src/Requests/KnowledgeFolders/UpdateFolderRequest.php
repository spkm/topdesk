<?php

namespace spkm\Topdesk\Requests\KnowledgeFolders;

use JsonSerializable;
use Saloon\Enums\Method;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Updates properties of the Folder: PATCH /services/knowledge-base-v1/folders/{identifier}.
 *
 * Updates the Folder with the given identifier. Using this endpoint, visibility, manager and externalLink can be
 * updated. Changes that affect the visibility for operators / users in linked branches take up to 5 minutes to become
 * effective. In order for an operator / operator group to be assigned as manager, the "Knowledge Base Manager" task
 * must be selected in the Supporting Files module.
 */
class UpdateFolderRequest extends WriteRequest
{
    protected Method $method = Method::PATCH;

    protected string $responseShape = self::NONE;

    protected ?string $contentType = 'application/x.topdesk-kb-update-folder-v1+json';

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
        return '/services/knowledge-base-v1/folders/'.Path::segment((string) $this->identifier);
    }
}
