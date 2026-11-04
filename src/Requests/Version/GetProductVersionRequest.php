<?php

namespace spkm\Topdesk\Requests\Version;

use spkm\Topdesk\Requests\GetRequest;

/**
 * Get TOPdesk version: GET /tas/api/productVersion.
 */
class GetProductVersionRequest extends GetRequest
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
        return '/tas/api/productVersion';
    }
}
