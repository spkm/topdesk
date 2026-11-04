<?php

namespace spkm\Topdesk\Requests\AssetCapabilities;

use spkm\Topdesk\Data\Assets\FrontendCapability;
use spkm\Topdesk\Requests\GetRequest;
use spkm\Topdesk\Support\Path;

/**
 * Returns the link type with the ID specified in the path: GET /tas/api/assetmgmt/capabilities/{capabilityId}.
 */
class GetCapabilityRequest extends GetRequest
{
    protected ?string $dto = FrontendCapability::class;

    /**
     * @param  array<string, mixed>  $options  Query options TOPdesk documents: includeUsage.
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
