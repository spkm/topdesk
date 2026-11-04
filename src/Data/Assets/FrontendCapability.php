<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A FrontendCapability record from TOPdesk's Asset Management API.
 */
readonly class FrontendCapability extends Data
{
    protected const LISTS = ['functionalities' => SimpleFunctionality::class];

    /**
     * @param  Collection<int, SimpleFunctionality>|null  $functionalities
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?CapabilityDto $capability = null,
        public ?Collection $functionalities = null,
        public array $extra = [],
    ) {}
}
