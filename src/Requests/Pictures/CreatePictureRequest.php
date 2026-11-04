<?php

namespace spkm\Topdesk\Requests\Pictures;

use spkm\Topdesk\Requests\UploadRequest;
use SplFileInfo;

/**
 * Upload an image: POST /tas/api/picture.
 */
class CreatePictureRequest extends UploadRequest
{
    /**
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(mixed $file, ?string $filename = null, array $fields = [], array $options = [])
    {
        $this->file = $file;
        $this->filename = $filename;
        $this->fields = $fields;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/picture';
    }
}
