<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use spkm\Topdesk\Data\Data;

/**
 * An updateMemoHistory record from TOPdesk's Operations Management API.
 */
readonly class UpdateMemoHistory extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $memoText = null,
        public array $extra = [],
    ) {}
}
