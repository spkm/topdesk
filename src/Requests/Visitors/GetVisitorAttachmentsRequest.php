<?php

namespace spkm\Topdesk\Requests\Visitors;

use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Get files attached to a visitor: GET /tas/api/visitors/{identifier}/attachments.
 *
 * Only available for operators. For SSP Users, use /requester/visitors/{identifier}/attachments instead.
 */
class GetVisitorAttachmentsRequest extends GetRequest
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
        return '/tas/api/visitors/'.Path::segment((string) $this->identifier).'/attachments';
    }
}
