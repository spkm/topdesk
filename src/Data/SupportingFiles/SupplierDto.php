<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A SupplierDto record from TOPdesk's Supporting Files API.
 */
readonly class SupplierDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?bool $forFirstLine = null,
        public ?bool $forSecondLine = null,
        public ?bool $forService = null,
        public ?bool $forOperationalActivity = null,
        public ?bool $forChangeManagement = null,
        public array $extra = [],
    ) {}
}
