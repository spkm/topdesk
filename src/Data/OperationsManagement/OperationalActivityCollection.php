<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * An OperationalActivityCollection record from TOPdesk's Operations Management API.
 */
readonly class OperationalActivityCollection extends Data
{
    protected const LISTS = ['item' => OperationalActivityWithAllFields::class];

    /**
     * @param  Collection<int, OperationalActivityWithAllFields>|null  $item
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?Collection $item = null,
        public ?string $next = null,
        public array $extra = [],
    ) {}
}
