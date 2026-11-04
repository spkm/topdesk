<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Data\Data;

readonly class ExampleChild extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public ?string $name = null,
        public ?int $size = null,
        public array $extra = [],
    ) {}
}
