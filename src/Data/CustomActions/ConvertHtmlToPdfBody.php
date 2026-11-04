<?php

namespace spkm\Topdesk\Data\CustomActions;

use spkm\Topdesk\Data\Data;

/**
 * A ConvertHtmlToPdfBody record from TOPdesk's Custom Action Support API.
 */
readonly class ConvertHtmlToPdfBody extends Data
{
    /**
     * @param  array<string, mixed>|null  $margin
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?string $html = null,
        public ?string $format = null,
        public ?string $width = null,
        public ?string $height = null,
        public ?array $margin = null,
        public array $extra = [],
    ) {}
}
