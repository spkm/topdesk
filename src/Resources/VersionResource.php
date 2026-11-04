<?php

namespace spkm\Topdesk\Resources;

use spkm\Topdesk\Data\Data;
use spkm\Topdesk\Requests\Version\GetProductVersionRequest;
use spkm\Topdesk\Requests\Version\GetVersionRequest;

/**
 * The version endpoints of TOPdesk's General API, from Topdesk::version().
 *
 * @extends BaseResource<Data>
 */
class VersionResource extends BaseResource
{
    /**
     * Get TOPdesk version: GET /tas/api/productVersion.
     *
     * @param  array<string, mixed>  $options  Query options.
     * @return array<string, mixed>|null
     */
    public function getProductVersion(array $options = []): ?array
    {
        return $this->fetch(new GetProductVersionRequest($options));
    }

    /**
     * Get API version: GET /tas/api/version.
     *
     * @param  array<string, mixed>  $options  Query options.
     * @return array<string, mixed>|null
     */
    public function getVersion(array $options = []): ?array
    {
        return $this->fetch(new GetVersionRequest($options));
    }
}
