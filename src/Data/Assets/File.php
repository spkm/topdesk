<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * A File record from TOPdesk's Asset Management API.
 */
readonly class File extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $created = null,
        public ?string $creatorId = null,
        public ?string $id = null,
        public ?int $lengthInBytes = null,
        public ?string $name = null,
        public ?Operator $operator = null,
        public ?string $url = null,
        public array $extra = [],
    ) {}
}
