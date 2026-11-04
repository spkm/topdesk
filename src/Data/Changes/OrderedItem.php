<?php

namespace spkm\Topdesk\Data\Changes;

use spkm\Topdesk\Data\Data;

/**
 * An OrderedItem record from TOPdesk's Change Management API.
 */
readonly class OrderedItem extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $name = null,
        public ?NameWrapper $type = null,
        public ?NameWrapper $manufacturer = null,
        public ?NameWrapper $model = null,
        public ?string $specification = null,
        public ?int $amount = null,
        public ?float $price = null,
        public array $extra = [],
    ) {}
}
