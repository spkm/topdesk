<?php

namespace spkm\Topdesk\Requests\KnowledgeItems;

use spkm\Topdesk\Requests\UploadRequest;
use spkm\Topdesk\Support\Path;
use SplFileInfo;

/**
 * Uploads an image to the Knowledge Item: POST /services/knowledge-base-v1/knowledgeItems/{identifier}/images.
 *
 * Uploads an image to an existing Knowledge Item with the given identifier. In order to upload an image the update
 * permission on Knowledge Items is necessary. Therefore, branch filters will not apply. It is not possible to upload
 * an image to an archived Knowledge Item and the allowed image formats are jpg, png, bmp and gif.
 */
class CreateKnowledgeItemImageRequest extends UploadRequest
{
    protected string $responseShape = self::NONE;

    /**
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
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
        return '/services/knowledge-base-v1/knowledgeItems/'.Path::segment((string) $this->identifier).'/images';
    }
}
