<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An UploadResponse record from TOPdesk's Asset Management API.
 */
readonly class UploadResponse extends Data
{
    protected const LISTS = ['dataSet' => File::class];

    /**
     * @param  Collection<int, File>|null  $dataSet
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $dataSet = null,
        public array $extra = [],
    ) {}
}
