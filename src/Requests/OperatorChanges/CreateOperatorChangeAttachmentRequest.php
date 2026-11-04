<?php

namespace spkm\Topdesk\Requests\OperatorChanges;

use spkm\Topdesk\Data\Changes\OperatorProgressTrailEntry;
use spkm\Topdesk\Requests\UploadRequest;
use spkm\Topdesk\Support\Path;
use SplFileInfo;

/**
 * Uploads a file as an attachment to this change: POST /tas/api/operatorChanges/{id}/attachments.
 *
 * Uploads a file as an attachment to this change. Returns the created progress trail entry in case of success.
 */
class CreateOperatorChangeAttachmentRequest extends UploadRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = OperatorProgressTrailEntry::class;

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
        return '/tas/api/operatorChanges/'.Path::segment((string) $this->id).'/attachments';
    }
}
