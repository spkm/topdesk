<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An OneKnowledgeItemToManyAssetsRequest record from TOPdesk's Asset Management API.
 */
readonly class OneKnowledgeItemToManyAssetsRequest extends Data
{
    /**
     * @param  array<mixed>|null  $assetIds
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $assetIds = null,
        public ?string $knowledgeItemId = null,
        public array $extra = [],
    ) {}
}
