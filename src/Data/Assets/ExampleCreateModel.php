<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An ExampleCreateModel record from TOPdesk's Asset Management API.
 */
readonly class ExampleCreateModel extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $dateField = null,
        public ?string $dropdownField = null,
        public ?string $numberField = null,
        public ?string $textField = null,
        public ?string $type_id = null,
        public array $extra = [],
    ) {}
}
