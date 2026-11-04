<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An OneTaskToManyAssetsRequest record from TOPdesk's Asset Management API.
 */
readonly class OneTaskToManyAssetsRequest extends Data
{
    /**
     * @param  array<mixed>|null  $assetIds
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $assetIds = null,
        public ?string $taskId = null,
        public ?string $taskType = null,
        public array $extra = [],
    ) {}
}
