<?php

namespace spkm\Topdesk\Requests\AssetCapabilities;

use spkm\Topdesk\Requests\DeleteRequest;
use spkm\Topdesk\Support\Path;

/**
 * Deletes a link type: DELETE /tas/api/assetmgmt/capabilities/{capabilityId}.
 */
class DeleteCapabilityRequest extends DeleteRequest
{
    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $capabilityId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/capabilities/'.Path::segment((string) $this->capabilityId);
    }
}
