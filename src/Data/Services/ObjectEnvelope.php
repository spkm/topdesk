<?php

namespace spkm\Topdesk\Data\Services;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An ObjectEnvelope record from TOPdesk's Services API.
 */
readonly class ObjectEnvelope extends Data
{
    protected const LISTS = ['results' => ObjectDto::class];

    /**
     * @param  Collection<int, ObjectDto>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
