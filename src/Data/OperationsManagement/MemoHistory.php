<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * A memoHistory record from TOPdesk's Operations Management API.
 */
readonly class MemoHistory extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $memoText = null,
        public ?CarbonImmutable $entryDate = null,
        public ?CarbonImmutable $creationDate = null,
        public ?CarbonImmutable $modificationDate = null,
        public ?int $flag = null,
        public ?IdAndName $operator = null,
        public array $extra = [],
    ) {}
}
