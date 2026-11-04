<?php

namespace spkm\Topdesk\Requests\AssetUploads;

use spkm\Topdesk\Data\Assets\File;
use spkm\Topdesk\Requests\UploadRequest;
use SplFileInfo;

/**
 * Uploads one or more blobs: POST /tas/api/assetmgmt/uploads.
 *
 * In the request body, one or more files can be uploaded, using multipart/form-data media type.
 */
class CreateUploadRequest extends UploadRequest
{
    protected string $responseShape = self::LIST;

    protected ?string $dto = File::class;

    /**
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: assetId.
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
        return '/tas/api/assetmgmt/uploads';
    }
}
