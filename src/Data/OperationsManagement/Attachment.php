<?php

namespace spkm\Topdesk\Data\OperationsManagement;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An attachment record from TOPdesk's Operations Management API.
 */
readonly class Attachment extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $type = null,
        public ?string $name = null,
        public ?int $size = null,
        public ?string $downloadUrl = null,
        public ?string $description = null,
        public ?CarbonImmutable $entryDate = null,
        public ?IdAndName $operator = null,
        public array $extra = [],
    ) {}
}
