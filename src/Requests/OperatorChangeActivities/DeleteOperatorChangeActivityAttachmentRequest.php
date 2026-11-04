<?php

namespace spkm\Topdesk\Requests\OperatorChangeActivities;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Deletes the attachment of the change activity: DELETE
 * /tas/api/operatorChangeActivities/{entityId}/attachments/{attachmentId}.
 */
class DeleteOperatorChangeActivityAttachmentRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $entityId, protected int|string $attachmentId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/operatorChangeActivities/'.Path::segment((string) $this->entityId).'/attachments/'.Path::segment((string) $this->attachmentId);
    }
}
