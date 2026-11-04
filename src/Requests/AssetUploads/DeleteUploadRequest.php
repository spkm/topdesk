<?php

namespace spkm\Topdesk\Requests\AssetUploads;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Removes an uploaded document: DELETE /tas/api/assetmgmt/uploads/{uploadId}.
 */
class DeleteUploadRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $uploadId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/uploads/'.Path::segment((string) $this->uploadId);
    }
}
