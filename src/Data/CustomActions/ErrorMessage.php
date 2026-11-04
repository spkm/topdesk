<?php

namespace spkm\Topdesk\Data\CustomActions;

use Carbon\CarbonImmutable;
use spkm\Topdesk\Data\Data;

/**
 * An ErrorMessage record from TOPdesk's Custom Action Support API.
 */
readonly class ErrorMessage extends Data
{
    /**
     * @param  array<string, mixed>  $extra  Fields TOPdesk sent that the model has no property for.
     */
    public function __construct(
        public ?CarbonImmutable $timestamp = null,
        public ?string $error = null,
        public ?string $errorId = null,
        public ?string $responseBody = null,
        public ?string $httpResponse = null,
        public array $extra = [],
    ) {}
}
