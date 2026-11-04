<?php

namespace spkm\Topdesk\Data\Assets;

use Illuminate\Support\Collection;
use spkm\Topdesk\Data\Data;

/**
 * A FieldResponse record from TOPdesk's Asset Management API.
 *
 * Response for a field resource
 */
readonly class FieldResponse extends Data
{
    protected const LISTS = ['functionalities' => Functionality::class];

    /**
     * @param  Collection<int, Functionality>|null  $functionalities
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $etag = null,
        public ?string $fieldType = null,
        public ?Collection $functionalities = null,
        public ?string $id = null,
        public ?string $name = null,
        public mixed $properties = null,
        public array $extra = [],
    ) {}
}
