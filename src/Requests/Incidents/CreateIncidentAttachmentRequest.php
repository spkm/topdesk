<?php

namespace spkm\Topdesk\Requests\Incidents;

use spkm\Topdesk\Data\Incidents\Attachment;
use spkm\Topdesk\Requests\UploadRequest;
use spkm\Topdesk\Support\Path;
use SplFileInfo;

/**
 * Upload a file to an incident identified by id: POST /tas/api/incidents/id/{incidentId}/attachments.
 */
class CreateIncidentAttachmentRequest extends UploadRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = Attachment::class;

    /**
     * @param  string|resource|SplFileInfo  $file  The file: its contents, a stream, or a file on disk.
     * @param  array<string, mixed>  $fields  Other form fields TOPdesk documents: invisibleForCaller, description.
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: non_api_attachment_urls.
     */
    public function __construct(protected int|string $incidentId, mixed $file, ?string $filename = null, array $fields = [], array $options = [])
    {
        $this->file = $file;
        $this->filename = $filename;
        $this->fields = $fields;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/incidents/id/'.Path::segment((string) $this->incidentId).'/attachments';
    }
}
