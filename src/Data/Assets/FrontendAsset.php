<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A FrontendAsset record from TOPdesk's Asset Management API.
 */
readonly class FrontendAsset extends Data
{
    protected const LISTS = ['functionalities' => SimpleFunctionality::class];

    /**
     * @param  array<string, mixed>|null  $data
     * @param  array<string, mixed>|null  $fields
     * @param  Collection<int, SimpleFunctionality>|null  $functionalities
     * @param  array<string, mixed>|null  $settings
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?array $data = null,
        public ?array $fields = null,
        public ?Collection $functionalities = null,
        public ?FrontendMetadata $metadata = null,
        public ?array $settings = null,
        public array $extra = [],
    ) {}
}
