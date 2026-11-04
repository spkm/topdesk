<?php

namespace spkm\Topdesk\Data\Services;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A ServiceEnvelope record from TOPdesk's Services API.
 */
readonly class ServiceEnvelope extends Data
{
    protected const LISTS = ['results' => ServiceListEntryDto::class];

    /**
     * @param  Collection<int, ServiceListEntryDto>|null  $results
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $results = null,
        public array $extra = [],
    ) {}
}
