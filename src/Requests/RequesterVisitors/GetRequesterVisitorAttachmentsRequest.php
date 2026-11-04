<?php

namespace spkm\Topdesk\Requests\RequesterVisitors;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get files attached to a visitor for SSP user: GET /tas/api/requester/visitors/{identifier}/attachments.
 *
 * The result is only available if SSP users can view visitors. This endpoint is not available for operators.
 */
class GetRequesterVisitorAttachmentsRequest extends GetRequest
{
    protected string $responseShape = self::RAW;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $identifier, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/requester/visitors/'.Path::segment((string) $this->identifier).'/attachments';
    }
}
