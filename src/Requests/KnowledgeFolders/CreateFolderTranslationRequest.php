<?php

namespace spkm\Topdesk\Requests\KnowledgeFolders;

use JsonSerializable;
use spkm\Topdesk\Requests\WriteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Creates a new translation for the Folder: POST
 * /services/knowledge-base-v1/folders/{identifier}/translations/{language}.
 *
 * Creates a new translation for the Folder with the given identifier in the specified language. The language must be
 * in TOPdesk's language list. It is necessary to have the permission to update Knowledge Items.
 */
class CreateFolderTranslationRequest extends WriteRequest
{
    protected string $responseShape = self::NONE;

    protected ?string $contentType = 'application/x.topdesk-kb-create-folder-translation-v1+json';

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $language, array|JsonSerializable $body = [], array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/folders/'.Path::segment((string) $this->identifier).'/translations/'.Path::segment((string) $this->language);
    }
}
