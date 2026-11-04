<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A LinkedAsset record from TOPdesk's Asset Management API.
 */
readonly class LinkedAsset extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?bool $archived = null,
        public ?bool $archivedAsset = null,
        public ?TemplateIcon $assetIcon = null,
        public ?string $assetId = null,
        public ?string $capabilityId = null,
        public ?string $capabilityName = null,
        public ?string $linkId = null,
        public ?string $linkType = null,
        public ?string $name = null,
        public ?string $status = null,
        public ?string $summary = null,
        public ?string $type = null,
        public array $extra = [],
    ) {}
}
