<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A CopyAssetResponseList record from TOPdesk's Asset Management API.
 */
readonly class CopyAssetResponseList extends Data
{
    protected const LISTS = ['dataset' => CopyAssetResponse::class];

    /**
     * @param  Collection<int, CopyAssetResponse>|null  $dataset
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $dataset = null,
        public array $extra = [],
    ) {}
}
