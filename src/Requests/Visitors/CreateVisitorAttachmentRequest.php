<?php

namespace spkm\Topdesk\Requests\Visitors;

use spkm\Topdesk\Requests\UploadRequest;
use spkm\Topdesk\Support\Path;
use SplFileInfo;

/**
 * Upload a file and attach it to a visitor: POST /tas/api/visitors/{identifier}/attachments.
 *
 * Only available for operators. For SSP Users, use /requester/visitors/{identifier}/attachments instead.
 */
class CreateVisitorAttachmentRequest extends UploadRequest
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
        return '/tas/api/visitors/'.Path::segment((string) $this->identifier).'/attachments';
    }
}
