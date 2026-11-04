<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use spkm\Topdesk\Data\Data;

/**
 * A createMemoHistory record from TOPdesk's Operations Management API.
 */
readonly class CreateMemoHistory extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $memoText = null,
        public ?int $flag = null,
        public array $extra = [],
    ) {}
}
