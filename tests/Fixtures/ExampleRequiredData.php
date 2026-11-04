<?php

namespace spkm\Topdesk\Tests\Fixtures;

use spkm\Topdesk\Data\Data;

/**
 * A model with a value it cannot be built without, and no $extra.
 */
readonly class ExampleRequiredData extends Data
{
    protected const EXTRA = false;

    public function __construct(
        public string $id,
        public ?string $name = null,
    ) {}
}
