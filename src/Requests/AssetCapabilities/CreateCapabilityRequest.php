<?php

namespace spkm\Topdesk\Requests\AssetCapabilities;

use JsonSerializable;
use spkm\Topdesk\Data\Assets\CapabilityDto;
use spkm\Topdesk\Requests\WriteRequest;

/**
 * Creates a new link type: POST /tas/api/assetmgmt/capabilities.
 */
class CreateCapabilityRequest extends WriteRequest
{
    protected string $responseShape = self::ONE;

    protected ?string $dto = CapabilityDto::class;

    /**
     * @param  array<mixed>|JsonSerializable  $body  The record, as an array of TOPdesk's field names or a model.
     * @param  array<string, mixed>  $options  Query options.
     */
    public function __construct(array|JsonSerializable $body, array $options = [])
    {
        $this->record = $body;
        $this->options = $options;
    }

    public function resolveEndpoint(): string
    {
        return '/tas/api/assetmgmt/capabilities';
    }
}
