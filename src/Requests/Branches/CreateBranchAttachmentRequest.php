<?php

namespace spkm\Topdesk\Requests\Branches;

use spkm\Topdesk\Data\SupportingFiles\BranchAttachmentDto;
use spkm\Topdesk\Requests\UploadRequest;
use spkm\Topdesk\Support\Path;
use SplFileInfo;

/**
 * Upload an attachment to a branch: POST /tas/api/branches/id/{id}/attachments.
 */
class CreateBranchAttachmentRequest extends UploadRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = BranchAttachmentDto::class;

    /**
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $id, mixed $file, ?string $filename = null, array $fields = [], array $options = [])
    {
        $this->file = $file;
        $this->filename = $filename;
        $this->fields = $fields;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/branches/id/'.Path::segment((string) $this->id).'/attachments';
    }
}
