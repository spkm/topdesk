<?php

namespace spkm\Topdesk\Requests\AssetCapabilities;

use spkm\Topdesk\Data\Assets\CapabilityDto;
use spkm\Topdesk\Requests\ActionRequest;
use spkm\Topdesk\Support\Path;

/**
 * Archives a link type: POST /tas/api/assetmgmt/capabilities/{capabilityId}/archive.
 *
 * Archives the link type identified by the provided ID (capabilityId).
 */
class ArchiveCapabilityRequest extends ActionRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = CapabilityDto::class;

    /**
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(protected int|string $capabilityId, array $options = [])
    {
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/capabilities/'.Path::segment((string) $this->capabilityId).'/archive';
    }
}
