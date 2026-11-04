<?php

namespace spkm\Topdesk\Data\SupportingFiles;

use spkm\Topdesk\Data\Data;

/**
 * An AvatarDto record from TOPdesk's Supporting Files API.
 */
readonly class AvatarDto extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $mimeType = null,
        public ?string $image = null,
        public ?string $initials = null,
        public array $extra = [],
    ) {}
}
