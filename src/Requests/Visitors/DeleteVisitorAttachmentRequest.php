<?php

namespace spkm\Topdesk\Requests\Visitors;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete attachment from visitor: DELETE /tas/api/visitors/{identifier}/attachments/{id}.
 *
 * Only available for operators. For SSP Users, use /requester/visitors/{identifier}/attachments/{id} instead.
 */
class DeleteVisitorAttachmentRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, protected int|string $id, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/visitors/'.Path::segment((string) $this->identifier).'/attachments/'.Path::segment((string) $this->id);
    }
}
