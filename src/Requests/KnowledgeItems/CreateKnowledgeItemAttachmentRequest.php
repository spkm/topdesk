<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Requests\UploadRequest;
use spkm\Topdesk\Support\Path;
use SplFileInfo;

/**
 * Uploads an attachment to a Knowledge Item: POST /services/knowledge-base-v1/knowledgeItems/{identifier}/attachments.
 *
 * Uploads an attachment to an existing Knowledge Item with the given identifier. In order to upload an attachment the
 * permission to update a Knowledge Item is necessary. Therefore, branch filters will not apply. It is not possible to
 * upload an attachment to an archived Knowledge Item.
 */
class CreateKnowledgeItemAttachmentRequest extends UploadRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields TOPdesk documents: description.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, mixed $file, ?string $filename = null, array $fields = [], array $options = [])
    {
        $this->file = $file;
        $this->filename = $filename;
        $this->fields = $fields;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/attachments';
    }
}
