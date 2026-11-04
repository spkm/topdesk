<?php

namespace spkm\Topdesk\Requests\RequesterChanges;

use spkm\Topdesk\Data\Changes\PublicProgressTrailEntry;
use spkm\Topdesk\Requests\UploadRequest;
use spkm\Topdesk\Support\Path;
use SplFileInfo;

/**
 * Uploads a file as an attachment to this change: POST /tas/api/requesterChanges/{id}/attachments.
 *
 * Uploads a file as an attachment to this change. Returns the created progress trail entry in case of success.
 */
class CreateRequesterChangeAttachmentRequest extends UploadRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = PublicProgressTrailEntry::class;

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
        return '/tas/api/requesterChanges/'.Path::segment((string) $this->id).'/attachments';
    }
}
