<?php

namespace spkm\Topdesk\Data\Assets;

use spkm\Topdesk\Data\Data;

/**
 * An UnlinkError record from TOPdesk's Asset Management API.
 */
readonly class UnlinkError extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $errorCode = null,
        public ?string $id = null,
        public array $extra = [],
    ) {}
}
