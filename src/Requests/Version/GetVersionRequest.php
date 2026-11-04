<?php

namespace spkm\Topdesk\Requests\Version;

use spkm\Topdesk\Requests\GetRequest;

/**
 * Get API version: GET /tas/api/version.
 */
class GetVersionRequest extends GetRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/version';
    }
}
