<?php

namespace spkm\Topdesk\Requests\OperationalActivities;

use spkm\Topdesk\Data\OperationsManagement\Attachment;
use spkm\Topdesk\Requests\UploadRequest;
use spkm\Topdesk\Support\Path;
use SplFileInfo;

/**
 * Uploads a file attachment to the operational activity: POST
 * /tas/api/operationalActivities/{identifier}/attachments/upload.
 *
 * Suitable for adding files, but not for links. See the type attribute of #/components/schemas/attachment.
 */
class UploadOperationalActivityAttachmentsRequest extends UploadRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = Attachment::class;

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
        return '/tas/api/operationalActivities/'.Path::segment((string) $this->identifier).'/attachments/upload';
    }
}
