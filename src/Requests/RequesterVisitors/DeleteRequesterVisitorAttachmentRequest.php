<?php

namespace spkm\Topdesk\Requests\RequesterVisitors;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Delete attachment from visitor for SSP user: DELETE /tas/api/requester/visitors/{identifier}/attachments/{id}.
 *
 * This is only available if SSP users can view visitors. This endpoint is not available for operators.
 */
class DeleteRequesterVisitorAttachmentRequest extends DeleteRequest
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
        return '/tas/api/requester/visitors/'.Path::segment((string) $this->identifier).'/attachments/'.Path::segment((string) $this->id);
    }
}
