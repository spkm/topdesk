<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * A SmallSupplierContactDto record from TOPdesk's Supporting Files API.
 */
readonly class SmallSupplierContactDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $id = null,
        public ?string $dynamicName = null,
        public ?string $firstName = null,
        public ?string $prefixes = null,
        public ?string $lastName = null,
        public ?SmallSupplierDto $supplier = null,
        public array $extra = [],
    ) {}
}
