<?php

namespace spkm\Topdesk\Requests\RequesterVisitors;

use spkm\Topdesk\Requests\UploadRequest;
use spkm\Topdesk\Support\Path;
use SplFileInfo;

/**
 * Upload a file and attach it to a visitor for SSP user: POST /tas/api/requester/visitors/{identifier}/attachments.
 *
 * This is only available if SSP users can view visitors. This endpoint is not available for operators.
 */
class CreateRequesterVisitorAttachmentRequest extends UploadRequest
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
        return '/tas/api/requester/visitors/'.Path::segment((string) $this->identifier).'/attachments';
    }
}
